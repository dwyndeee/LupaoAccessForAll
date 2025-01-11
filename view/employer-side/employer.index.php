<?php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../../index.php');
    exit;
}

$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : 'Guest';
$lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : 'Guest';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
$id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

if (strtolower($role) !== 'employer') {
    header('Location: ../../unauthorized.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $role ?> Side | Lupao Scholarship and Enrollment Portal</title>

    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../../assets/img/Lupao_Nueva_Ecija_seal_logo.png">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="employer.index.php">
                <div class="sidebar-brand-icon" style="width: 50px; height: 40px;">
                    <img src="../../assets/img/Lupao_Nueva_Ecija_seal_logo.png" alt="Logo" style="width: 100%; height: 100%;">
                </div>
                <div class="sidebar-brand-text mx-3">Access For All</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="employer.index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Management Pages
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEmployment"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Employment</span>
                </a>
                <div id="collapsePagesEmployment" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="employer.applicant-pending.php">Pending Application</a>
                        <a class="collapse-item" href="employer.applicant-approved.php">Approved Application</a>
                        <a class="collapse-item" href="employer.applicant.rejected.php">Rejected Application</a>
                        <a class="collapse-item" href="employer.jobs.php">Job Openings</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php
                include('employer-header.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Welcome aboard! <?php echo $firstname . " " . $lastname; ?></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Available Jobs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="jobsCount">525</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Job Registration</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="pendingJobsCount">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Registrations (Monthly)</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Available to Apply</h6>
                                </div>

                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                        </div>

                        <div class="col-lg-6 mb-4">

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Lupao Scholarship & Employment Portal</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../controllers/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <!-- Page level plugins -->
    <script src="../../assets/vendor/chart.js/Chart.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('../../controllers/analyticsController.php?getChartData=true')
                .then(response => response.json())
                .then(data => {
                    const pieChartData = data.pieChartData;

                    if (pieChartData && pieChartData.length) {
                        const labels = pieChartData.map(item => item.label);
                        const values = pieChartData.map(item => item.value);

                        var ctx = document.getElementById("myPieChart");
                        var myPieChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: values,
                                    backgroundColor: ['#0B3677', '#1cc88a'],
                                    hoverBackgroundColor: ['#2e59d9', '#17a673'],
                                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                                }],
                            },
                            options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    caretPadding: 10,
                                },
                                legend: {
                                    display: true
                                },
                                cutoutPercentage: 80,
                            },
                        });
                    } else {
                        console.warn('No pie chart data available');
                    }
                })
                .catch(error => console.error('Error fetching pie chart data:', error));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('../../controllers/analyticsController.php?monthlyRegistrations=true')
                .then(response => response.json())
                .then(data => {
                    const monthlyData = data.monthlyData;

                    if (monthlyData && monthlyData.length) {
                        const labels = monthlyData.map(item => item.month);
                        const values = monthlyData.map(item => item.count);

                        const ctx = document.getElementById("myAreaChart");
                        const myAreaChart = new Chart(ctx, {
                            type: 'line', // Area chart with a filled line type
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: "Registrations",
                                    data: values,
                                    backgroundColor: "rgba(78, 115, 223, 0.1)", // Light background color for area
                                    borderColor: "rgba(78, 115, 223, 1)", // Line color
                                    borderWidth: 2,
                                    fill: true, // Fill area under line
                                }],
                            },
                            options: {
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        type: 'time',
                                        time: {
                                            unit: 'month'
                                        },
                                        title: {
                                            display: true,
                                            text: 'Month'
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Registrations'
                                        }
                                    }
                                },
                                plugins: {
                                    tooltip: {
                                        backgroundColor: "rgba(255,255,255,0.8)",
                                        bodyFontColor: "#333",
                                        borderColor: '#ddd',
                                        borderWidth: 1,
                                    },
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                }
                            }
                        });
                    } else {
                        console.warn('No data available for area chart');
                    }
                })
                .catch(error => console.error('Error fetching monthly registrations data:', error));
        });
    </script>

    <script>
        var ownerId = '<?php echo $id; ?>'; // PHP session variable embedded in JavaScript                
        let isDropdownOpen = false; // Track the dropdown state

        $(document).ready(function() {

            var ownerId = '<?php echo $id; ?>'; // PHP session variable embedded in JavaScript                

            console.log(ownerId);

            $.ajax({
                url: '../../controllers/analyticsController.php', // Update this path to the actual PHP file location
                type: 'POST',
                data: {
                    jobsCount: true,
                    ownerId: ownerId
                }, // You can specify an ownerId if needed
                dataType: 'json',
                success: function(response) {
                    console.log("Jobs Count:", response.jobsCount);
                    // Use the count as needed, for example:
                    $('#jobsCount').text(response.jobsCount);
                },
                error: function(error) {
                    console.error("Error fetching jobs count:", error);
                }
            });

            $.ajax({
                url: '../../controllers/analyticsController.php', // Update this path to the actual PHP file location
                type: 'POST',
                data: {
                    pendingJobApplicationsCount: true,
                    ownerId: ownerId
                }, // You can specify an ownerId if needed
                dataType: 'json',
                success: function(response) {
                    console.log("Jobs Count:", response.pendingJobApplicationsCount);
                    // Use the count as needed, for example:
                    $('#pendingJobsCount').text(response.pendingJobApplicationsCount);
                },
                error: function(error) {
                    console.error("Error fetching jobs count:", error);
                }
            });

            // SEND MESSAGES
            $.ajax({
                url: '../../controllers/adminController.php', // Your controller path
                type: 'POST',
                data: {
                    getAllUsers: true
                }, // Adjust this to match the controller’s POST variable
                dataType: 'json',
                success: function(response) {
                    if (response.success === true) {
                        let usersData = response.usersData; // Your fetched user data
                        let tbody = $('#userTable tbody'); // Targeting tbody of the DataTable
                        tbody.empty(); // Clear existing rows
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
                            tbody.append(row); // Add the new row to the table
                        });

                        // new simpleDatatables.DataTable(document.getElementById('userTable'));
                        const dataTable = new simpleDatatables.DataTable(document.getElementById('userTable'), {
                            searchable: true, // Ensure search is enabled
                            perPage: 10, // Add pagination if needed
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

            $(document).on('click', '#sendMessageButton', function() {
                const userId = $('#userSenderId').val();
                const userReceiverId = $('#userReceiverId').val();
                const userName = $('#userName').val();
                const userMessage = $('#userMessage').val();

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
                    success: function(response) {
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
                    error: function() {
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
                    url: '../../controllers/messageController.php', // URL to fetch messages
                    type: 'POST',
                    data: {
                        getUnreadCount: true,
                        sender_id: ownerId
                    },
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response); // Check the response structure

                        if (response.success === true) {
                            let unreadCount = response.unreadCount; // Assuming response contains unread count
                            let unreadCountElement = $('#unread_count'); // Targeting the unread count badge

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
                    data: {
                        getMessages: true,
                        sender_id: ownerId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // console.log(response);

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
                    data: {
                        getConversation: true,
                        message_id: messageId,
                        sender_id: senderId
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Log the response to the console to check the structure

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

                            $('#conversation').html(conversationHtml); // Inject the conversation HTML into the modal body
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
                    data: {
                        markMessageAsRead: true,
                        message_id: messageId
                    },
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
                                $('#conversation').append(newMessageHtml); // Append new message to conversation
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

        });
    </script>

</body>

</html>