<?php

session_start();

require "../db/dbconfig.php";

require "../vendor/autoload.php"; // Include Composer's autoload for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$db = new DB();

if (isset($_POST['sendMessage'])) {
    try {
        // Fetching POST data
        $senderId = isset($_POST['userSenderId']) ? $_POST['userSenderId'] : "";
        $receiverId = isset($_POST['userReceiverId']) ? $_POST['userReceiverId'] : "";
        $message = isset($_POST['userMessage']) ? $_POST['userMessage'] : "";

        // Validating inputs
        if (!empty($senderId) && !empty($receiverId) && !empty($message)) {

            // Set timezone
            $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
            $date = new DateTime('now', $timezone); // Get the current time in that timezone
            $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

            // Data to insert into the messages table
            $data = [
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'message' => $message,
                'created_at' => $createdAt,
            ];

            // Insert message into database
            if ($db->insert('messages_table', $data)) {

                // Log the activity
                $userId = $_SESSION['id']; // Assuming user ID is stored in session
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                $activityLogData = [
                    'user_id' => $userId,
                    'activity_name' => "Sent a message to User ID $receiverId",
                    'date' => $createdAt
                ];
                $db->insert('activity_log', $activityLogData);

                // Respond with success
                echo json_encode(['success' => true, 'message' => 'Message sent successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send the message.']);
            }

        } else {
            // Validation error
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        }

    } catch (Exception $e) {
        // Catch and log any exceptions
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again.']);
    }
}

if (isset($_POST['getUnreadCount'])) {
    try {
        
        $sender_id = $_SESSION['id'];  
        $receiver_id = NULL;  

        // echo json_encode(['sender_id' => $sender_id]);

        $unreadCount = $db->getUnreadMessagesCount($sender_id);

        // Send back the data as JSON
        echo json_encode([
            'success' => true,
            'unreadCount' => $unreadCount
        ]);

    } catch (Exception $e) {
        // Handle any exceptions and return error message
        echo json_encode([
            'success' => false,
            'message' => 'An error occurred while fetching messages.'
        ]);
    }
}

if (isset($_POST['getMessages'])) {
    try {
        
        $sender_id = isset($_POST['sender_id']) ? $_POST['sender_id'] : NULL;

        if ($sender_id === NULL) {
            echo json_encode([
                'success' => false,
                'message' => 'Sender IDs are required.'
            ]);
            exit;
        }

        $messages = $db->getAllMessages($sender_id);

        echo json_encode([
            'success' => true,
            'messages' => $messages
        ]);
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'An error occurred while fetching messages: ' . $e->getMessage()
        ]);
    }
}

if (isset($_POST['getConversation'])) {
    try {
        // Fetch the message_id from POST data
        $messageId = isset($_POST['message_id']) ? $_POST['message_id'] : null;
        $senderId = isset($_POST['sender_id']) ? $_POST['sender_id'] : null;


        if ($messageId === null) {
            echo json_encode([
                'success' => false,
                'message' => 'Message ID is required.'
            ]);
            exit;
        }

        // Fetch the conversation based on the message_id
        $conversation = $db->getConversationByMessageId($messageId, $senderId);

        if ($conversation) {
            // Return the conversation data in JSON format
            echo json_encode([
                'success' => true,
                'conversation' => $conversation
            ]);
        } else {
            // No conversation found for the given message_id
            echo json_encode([
                'success' => false,
                'message' => 'No conversation found for the given message ID.'
            ]);
        }

    } catch (Exception $e) {
        // Catch any exceptions and return an error message
        echo json_encode([
            'success' => false,
            'message' => 'An error occurred while fetching the conversation: ' . $e->getMessage()
        ]);
    }
}

if (isset($_POST['markMessageAsRead'])) {
    try {
        $message_id = isset($_POST['message_id']) ? $_POST['message_id'] : null;

        if ($message_id === null) {
            echo json_encode([
                'success' => false,
                'message' => 'Message ID is required.'
            ]);
            exit;
        }

        $result = $db->markMessageAsRead($message_id);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Message marked as read.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to mark the message as read.'
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'An error occurred: ' . $e->getMessage()
        ]);
    }
}

if (isset($_POST['replyMessage'])) {
    try {
        // Fetching POST data
        $senderId = isset($_POST['sender_id']) ? $_POST['sender_id'] : "";
        $receiverId = isset($_POST['recipient_id']) ? $_POST['recipient_id'] : "";
        $message = isset($_POST['message']) ? $_POST['message'] : "";

        // Validating inputs
        if (!empty($senderId) && !empty($receiverId) && !empty($message)) {

            // Set timezone
            $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
            $date = new DateTime('now', $timezone); // Get the current time in that timezone
            $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

            // Data to insert into the messages table
            $data = [
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'message' => $message,
                'created_at' => $createdAt,
            ];

            // Insert message into database
            if ($db->insert('messages_table', $data)) {

                // Log the activity
                $userId = $_SESSION['id']; // Assuming user ID is stored in session
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                $activityLogData = [
                    'user_id' => $userId,
                    'activity_name' => "Sent a message to User ID $receiverId",
                    'date' => $createdAt
                ];
                $db->insert('activity_log', $activityLogData);

                // Respond with success
                echo json_encode(['success' => true, 'message' => 'Message sent successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send the message.']);
            }

        } else {
            // Validation error
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        }

    } catch (Exception $e) {
        // Catch and log any exceptions
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again.']);
    }
}

