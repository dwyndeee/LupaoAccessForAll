
var ownerId = '<?php echo $id; ?>'; // PHP session variable embedded in JavaScript                
// let isDropdownOpen = false; // Track the dropdown state

$(document).ready(function(){

    // SEND MESSAGES
    $.ajax({
        url: '../../controllers/adminController.php',  // Your controller path
        type: 'POST',
        data: { getAllUsers: true },  // Adjust this to match the controller’s POST variable
        dataType: 'json',
        success: function(response) {
            if (response.success === true) {
                let usersData = response.usersData;  // Your fetched user data
                let tbody = $('#userTable tbody');  // Targeting tbody of the DataTable
                tbody.empty();  // Clear existing rows
                usersData.forEach(function(user, index) {
                    // Create the table row
                    let row = `<tr>
                        <td>${user.firstname + " " + user.lastname}</td>
                        <td>
                            <!-- Select Button -->
                            <button type="button" class="btn btn-primary btn-sm selectUser" data-toggle="modal" data-target="#sendMessage" data-user-id="${user.id}" data-user-name="${user.firstname} ${user.lastname}">
                                <i class="fas fa-paper-plane"></i>
                                Send
                            </button>
                        </td>
                    </tr>`;
                    tbody.append(row);  // Add the new row to the table
                });

                // new simpleDatatables.DataTable(document.getElementById('userTable'));
                const dataTable = new simpleDatatables.DataTable(document.getElementById('userTable'), {
                    searchable: true, // Ensure search is enabled
                    perPage: 10,      // Add pagination if needed
                });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Request Failed',
                text: 'Something went wrong while fetching the data. Please try again.',
            });
        }
    });

    // Populate sendMessageModal when the "Send" button is clicked
    $(document).on('click', '.selectUser', function() {
        const userId = $(this).data('user-id');
        const userName = $(this).data('user-name'); 

        // Populate the input field in the sendMessageModal
        $('#sendMessage #userSenderId').val(ownerId);
        $('#sendMessage #userReceiverId').val(userId);
        $('#sendMessage #userName').val(userName);
    });

    $(document).on('click', '#sendMessageButton', function () {
        const userId = $('#userSenderId').val();
        const userReceiverId = $('#userReceiverId').val();
        const userName = $('#userName').val();
        const userMessage  = $('#userMessage').val();

        if (!userMessage) {
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: 'Please enter a message before sending.',
            });
            return;
        }

        $.ajax({
            url: '../../controllers/messageController.php',
            type: 'POST',
            data: {
                sendMessage: true,
                userSenderId: userId,
                userReceiverId: userReceiverId,
                userMessage: userMessage,
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sent',
                        text: response.message,
                    }).then(() => {
                        $('#sendMessageForm')[0].reset(); // Clear form
                        $('#sendMessage').modal('hide'); // Hide modal
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Request Failed',
                    text: 'Something went wrong. Please try again.',
                });
            },
        });
    });

    function fetchUnreadMessageCount() {
        $.ajax({
            url: '../../controllers/messageController.php',  // URL to fetch messages
            type: 'POST',
            data: { getUnreadCount: true, sender_id: ownerId },
            dataType: 'json',
            success: function(response) {
                console.log(response);  // Check the response structure

                if (response.success === true) {
                    let unreadCount = response.unreadCount;  // Assuming response contains unread count
                    let unreadCountElement = $('#unread_count');  // Targeting the unread count badge

                    // Update unread count
                    unreadCountElement.text(unreadCount);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Request Failed',
                    text: 'Something went wrong. Please try again.',
                });
            }
        });
    }

    function fetchMessages() {
        $.ajax({
            url: '../../controllers/messageController.php',
            type: 'POST',
            data: { getMessages: true, sender_id: ownerId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log(response);

                    var messages = response.messages;
                    var messageListHtml = '';

                    if (messages.length === 0) {
                        messageListHtml = '<div class="dropdown-item d-flex align-items-center">No messages available</div>';
                    } else {
                        messages.forEach(function(message) {
                            let senderName = message.sender_user_name || "";
                            let initials = senderName
                                .split(" ")
                                .map(word => word[0])
                                .join("")
                                .toUpperCase();

                            let date = new Date(message.created_at);
                            let formattedTime = date.toLocaleTimeString([], {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });

                            // Here we pass the message id to open the conversation
                            messageListHtml += `
                                <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="modal" data-target="#messageModal" data-message-id="${message.id}" data-sender-id="${message.sender_id}">
                                    <div class="dropdown-list-image mr-3">
                                        <div class="rounded-circle bg-primary d-flex justify-content-center align-items-center text-white" 
                                            style="width: 40px; height: 40px; font-size: 16px;">
                                            ${initials}
                                        </div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">${message.message}</div>
                                        <div class="small text-gray-500">${message.sender_user_name}  ${formattedTime}</div>
                                    </div>
                                </a>
                            `;
                        });
                    }

                    $('#message-list').html(messageListHtml);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Could not fetch messages.',
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Request Failed',
                    text: 'Something went wrong. Please try again.',
                });
            }
        });
    }

    function fetchConversation(messageId, senderId) {
        var ownerId = '<?php echo $id; ?>'; // PHP session variable embedded in JavaScript

        $.ajax({
            url: '../../controllers/messageController.php',
            type: 'POST',
            data: { getConversation: true, message_id: messageId, sender_id: senderId },
            dataType: 'json',
            success: function(response) {
                console.log(response);  // Log the response to the console to check the structure

                if (response.success) {
                    const conversation = response.conversation;
                    let conversationHtml = '';

                    conversation.forEach(function(message) {
                        // Ensure sender name is defined; use "You" if undefined
                        let senderName = message.sender_user_name || "You";

                        // Ensure created_at is defined; use current time if undefined
                        let date = message.created_at ? new Date(message.created_at) : new Date();
                        let formattedTime = date.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: true
                        });

                        // Adjust layout based on whether the current user or the other user is sending the message
                        if (message.sender_id === ownerId) {
                            // For the current user
                            conversationHtml += `
                                <div class="message-item d-flex justify-content-end">
                                    <div class="message" style="background-color: #e1f7d5; border-radius: 10px; padding: 8px 12px; max-width: 60%;">
                                        <div class="sender">You <span class="text-gray-500">${formattedTime}</span></div>
                                        <div class="message-text">${message.message}</div>
                                    </div>
                                </div>
                            `;
                        } else {
                            // For the other user
                            conversationHtml += `
                                <div class="message-item d-flex justify-content-start">
                                    <div class="message" style="background-color: #f1f1f1; border-radius: 10px; padding: 8px 12px; max-width: 60%;">
                                        <div class="sender">${senderName} <span class="text-gray-500">${formattedTime}</span></div>
                                        <div class="message-text">${message.message}</div>
                                    </div>
                                </div>
                            `;
                        }
                    });

                    $('#conversation').html(conversationHtml);  // Inject the conversation HTML into the modal body
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Could not fetch the conversation.',
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Request Failed',
                    text: 'Something went wrong while loading the conversation.',
                });
            }
        });
    }

    function markMessageAsRead(messageId) {
        $.ajax({
            url: '../../controllers/messageController.php',
            type: 'POST',
            data: { markMessageAsRead: true, message_id: messageId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log(response.message); // Message marked as read
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Request failed: ' + error);
            }
        });
    }

    $('#sendReply').on('click', function() {
        const message = $('#replyMessage').val().trim(); // Get the message
        const recipientId = $('#messageModal').data('recipient-id'); // Assume recipient ID is stored when opening the modal
        const senderId = ownerId; // Assuming you have the ownerId available

        if (message !== '') {

            const currentDate = new Date();
            const currentTime = currentDate.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });

            $.ajax({
                url: '../../controllers/messageController.php',
                type: 'POST',
                data: {
                    replyMessage: true,
                    message: message,
                    recipient_id: recipientId,
                    sender_id: senderId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#replyMessage').val(''); // Clear the input field

                        const newMessageHtml = `
                            <div class="message-item d-flex justify-content-end">
                                <div class="message mb-3" style="background-color: #e1f7d5; border-radius: 10px; padding: 8px 12px; max-width: 60%;">
                                    <div class="sender">You <span class="text-gray-500">${currentTime}</span></div>
                                    <div class="message-text">${message}</div>
                                </div>
                            </div>
                        `;
                        $('#conversation').append(newMessageHtml);  // Append new message to conversation
                        $('#conversation').scrollTop($('#conversation')[0].scrollHeight); // Scroll to the bottom
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Could not send the message.',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Request Failed',
                        text: 'Something went wrong. Please try again.',
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Message',
                text: 'Please type a message before sending.',
            });
        }
    });

    // When a message is clicked, load the conversation
    $('#message-list').on('click', '.dropdown-item', function() {
        var messageId = $(this).data('message-id');
        var senderId = $(this).data('sender-id');

        $('#messageModal').data('recipient-id', senderId); // Store the recipient ID
        fetchConversation(messageId, senderId);
        markMessageAsRead(messageId);

    });

    setInterval(function() {
        fetchMessages();
        fetchUnreadMessageCount();
    }, 5000);

    // fetchMessages();
    // fetchUnreadMessageCount();

});
