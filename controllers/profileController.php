<?php

session_start();

require "../db/dbconfig.php";

require "../vendor/autoload.php"; // Include Composer's autoload for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$db = new DB();

if (isset($_POST['getUserDetails'])) {
    $userId = $_POST['userId']; // Get user ID from AJAX request

    try {
        $userDetails = $db->getUserDetails($userId);

        if ($userDetails) {
            echo json_encode(['success' => TRUE, 'userDetails' => $userDetails]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'User not found']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching user details.']);
    }
}

if (isset($_POST['updateUserDetails'])) {
    $userData = $_POST['userData']; // Get user data from AJAX request

    try {
        // Assume your update method is defined in your DB class
        $updated = $db->update('user_table', // Replace with your actual table name
            [
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname'],
                'baranggay' => $userData['barangay'],
                'contact_no' => $userData['contact_no'],
                'birthday' => $userData['birthday'],
                'gender' => $userData['gender'],
                'email' => $userData['email']
            ],
            ['id' => $userData['userId']]
        );

        if ($updated) {
            // Set timezone
            $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
            $date = new DateTime('now', $timezone); // Get the current time in that timezone
            $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

            $activity_data = [
                'user_id' => $userData['userId'],
                'activity_name' => 'Profile Edited',
                'date' => $createdAt
            ];
            $db->insert('activity_log', $activity_data);
            
            echo json_encode(['success' => true, 'message' => 'User details updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update user details.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while updating user details.']);
    }
}

if (isset($_POST['getUserLog'])) {
    
    $userId = $_POST['userId']; // Get user ID from AJAX request

    try {
        $userLogDetails = $db->getAllUserLog($userId);

        if ($userLogDetails) {
            echo json_encode(['success' => TRUE, 'userLogDetails' => $userLogDetails]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'User log not found']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching user log details.']);
    }
}

if (isset($_POST['clearLogs'])) {
    try {

        $userId = $_POST['userId']; // Get user ID from AJAX request
        $userName = $_SESSION['firstname'];
        $userLastname = $_SESSION['lastname'];

        // echo json_encode(['userId' => $userId]);
        // exit();

        if ($userId > 0) {
            
            $where = ['user_id' => $userId];

            if ($db->clearLogs('activity_log', $where)) {
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d'); // Format the date in 'Y-m-d H:i:s'
                $timeAt = $date->format('H:i:s');

                $activity_log_data = [
                    'user_id' => $_SESSION['id'], // Assuming user ID is stored in session
                    'activity_name' => "$userName $userLastname cleared logs", // Activity name
                    'date' => $createdAt, // Current timestamp
                    'time' => $timeAt,
                ];

                // Insert the activity log
                $db->insert('activity_log', $activity_log_data);

                $_SESSION['success'] = 'Logs cleared successfully';
                echo json_encode(['success' => true, 'message' => 'Logs cleared successfully.']);
            } else {
                $_SESSION['failed'] = 'Delete failed. Please try again';
                echo json_encode(['success' => false, 'message' => 'Logs deletion failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID provided.']);
        }

    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while deleting the program.']);
    }
}

