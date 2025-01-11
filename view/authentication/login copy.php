<?php
    session_start();

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

        switch (strtolower($role)) {
            case 'admin':
                header('Location: ./view/admin-side/admin.index.php');
                break;
            case 'employer':
                header('Location: ./view/employer-side/employer.index.php');
                break;
            case 'applicant':
                header('Location: ./view/applicant-side/applicant.index.php');
                break;
            default:
                header('Location: ./index.php'); 
                break;
        }
        exit();
    }

    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupao - Scholarship and Employment Portal</title>
    <script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>
    <link rel="icon" href="assets/img/Lupao_Nueva_Ecija_seal_logo.png">
    <link rel="stylesheet" href="././assets/css/loginstyle.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>
<body>

    <div class="container">
        <div class="left-section">
            <div class="logo-container">
                <img src="././assets/img/isko.png" alt="Logo">
            </div>
        </div>

        <div class="right-section">
            <div class="form-container">
                <div id="signup-form" class="hidden">
                    <h2>Sign Up</h2>
                    <form class="signup_form" action="#" method="POST">

                        <!-- Role Selection -->
                        <select class="form-select" id="user_type" name="user_type" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="2">Employer</option>
                            <option value="3">User</option>
                        </select>

                        <div id="register-response"></div>
                        <input type="text" id="register-firstname" name="register-firstname" placeholder="Firstname" required>
                        <input type="text" id="register-lastname" name="register-lastname" placeholder="Lastname" required>
                        <input type="email" id="register-email" name="register-email" placeholder="Email Address" required>
                        <input type="password" id="register-password" name="register-password" placeholder="Password" required>

                        <div id="documents-section" style="display: none;">
                            <label for="psa">Upload PSA:</label>
                            <input type="file" id="psa" name="psa">

                            <label for="gov_id">Upload Gov ID:</label>
                            <input type="file" id="gov_id" name="gov_id">

                            <label for="business_permit">Upload Business Permit:</label>
                            <input type="file" id="business_permit" name="business_permit">

                            <label for="cedula">Upload Cedula:</label>
                            <input type="file" id="cedula" name="cedula">
                        </div>

                        <button type="submit" id="signup-btn">Sign Up</button>
                    </form>
                    <p>Already have an account? <a href="#" id="show-login">Log In</a></p>
                </div>

                <div id="login-form">
                    <h2>Log In</h2>
                    <form id="login-form" class="login-form" action="#" method="POST">
                        <div id="response"></div>
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <a href="#" id="show-forgot-password">Forgot Password?</a>
                        <button type="submit">Log In</button>
                    </form>
                    <p>Don't have an account? <a href="#" id="show-signup">Sign Up</a></p>
                </div>

                <div id="forgot-password-form" class="hidden">
                    <h2>Forgot Password</h2>
                    <form id="forgot-password" action="#" method="POST">
                        <div id="forgot-response"></div>
                        <input type="email" id="forgot-email" name="forgot-email" placeholder="Email Address" required>
                        <button type="submit" id="forgot-btn">Submit</button>
                    </form>
                    <p>Remembered your password? <a href="#" id="show-login-from-forgot">Log In</a></p>
                </div>

            </div>
        </div>
    </div>

    <script src="././assets/js/jquery.min.js"></script>
    <script src="././assets/js/script.js"></script>
    <script>
        document.getElementById('show-login').addEventListener('click', function() {
            document.getElementById('signup-form').classList.add('hidden');
            document.getElementById('forgot-password-form').classList.add('hidden');
            document.getElementById('login-form').classList.remove('hidden');
        });

        document.getElementById('show-signup').addEventListener('click', function() {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('forgot-password-form').classList.add('hidden');
            document.getElementById('signup-form').classList.remove('hidden');
        });

        document.getElementById('show-forgot-password').addEventListener('click', function() {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('signup-form').classList.add('hidden');
            document.getElementById('forgot-password-form').classList.remove('hidden');
        });

        document.getElementById('show-login-from-forgot').addEventListener('click', function() {
            document.getElementById('forgot-password-form').classList.add('hidden');
            document.getElementById('signup-form').classList.add('hidden');
            document.getElementById('login-form').classList.remove('hidden');
        });
    </script>

    <script>
        $(document).ready(function () {

            $('#user_type').on('change', function() {
                var user_type = $(this).val();
                
                if (user_type == 2) {
                    $('#documents-section').show();  // Show document upload section
                } else {
                    $('#documents-section').hide();  // Hide if not user_type 2
                }
            });

            $('.signup_form').on('submit', function(e) {
                e.preventDefault();

                const loadingAlert = Swal.fire({
                    title: 'Submitting. Please Wait',
                    text: 'Your registration is being processed.',
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    allowOutsideClick: false,
                    showConfirmButton: false
                });

                // Create a FormData object to include files
                var formData = new FormData(this);
                formData.append('signup_user', true); // Add additional data if needed

                // Disable the signup button to prevent multiple submissions
                $('#signup-btn').prop('disabled', true);

                $.ajax({
                    type: 'POST',
                    url: './controllers/authenticationController.php',
                    data: formData,
                    contentType: false, // Important for file uploads
                    processData: false, // Important for file uploads
                    success: function(response) {
                        try {
                            response = JSON.parse(response);
                            loadingAlert.close();

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registration Successful',
                                    text: response.message,
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Registration Failed',
                                    text: response.message,
                                    confirmButtonText: 'OK'
                                });
                            }
                        } catch (e) {
                            console.error("Error parsing JSON response:", e);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An unexpected error occurred. Please try again.'
                            });
                        } finally {
                            // Re-enable the signup button
                            $('#signup-btn').prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                        loadingAlert.close(); 
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred. Please try again.',
                            confirmButtonText: 'OK'
                        });
                        // Re-enable the signup button
                        $('#signup-btn').prop('disabled', false);
                    }
                });
            });


            $('.login-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: './controllers/authenticationController.php',
                    data: {
                        logged_user: true,
                        email: $('#email').val(),
                        password: $('#password').val()
                    },
                    success: function(response) {
                        console.log(response);
                        try {
                            response = JSON.parse(response);
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Login Successful!',
                                    text: 'Welcome back, ' + response.firstname + ' ' + response.lastname + '!',
                                    timer: 2000,
                                    showConfirmButton: false
                                })
                                .then(function() {
                                    window.location.href = response.redirect;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login Failed',
                                    text: response.message
                                });
                            }
                        } catch (e) {
                            console.error("Error parsing JSON response:", e);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An unexpected error occurred. Please try again.'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred during the request. Please try again.'
                        });
                    }
                });
            });

            $('#forgot-password').on('submit', function(e) {
                e.preventDefault();

                const loadingAlert = Swal.fire({
                    title: 'Submitting. Please Wait',
                    text: 'Your password reset is being processed.',
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    allowOutsideClick: false, 
                    showConfirmButton: false 
                });
                
                $.ajax({
                    type: 'POST',
                    url: './controllers/authenticationController.php',
                    data: {
                        forgot_password: true,
                        email: $('#forgot-email').val()
                    },
                    success: function(response) {
                        try {
                            response = JSON.parse(response);
                            loadingAlert.close(); // Close the loading alert

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Email Sent!',
                                    text: response.message,
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById('forgot-password-form').classList.add('hidden');
                                        document.getElementById('login-form').classList.remove('hidden');
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message
                                });
                            }
                        } catch (e) {
                            console.error("Error parsing JSON response:", e);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An unexpected error occurred. Please try again.'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        loadingAlert.close(); 
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred during the request. Please try again.'
                        });
                    }
                });
            });
        });
    </script>

</body>
</html>
