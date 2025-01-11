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
                            <option value="3">Applicant</option>
                        </select>

                        <div id="register-response"></div>
                        <input type="text" id="register-firstname" name="register-firstname" placeholder="Firstname" required>
                        <input type="text" id="register-lastname" name="register-lastname" placeholder="Lastname" required>
                        <input type="email" id="register-email" name="register-email" placeholder="Email Address" required>
                        <input type="password" id="register-password" name="register-password" placeholder="Password" required>

                        <select class="form-select" id="barangay" name="barangay" required>
                            <option value="" disabled selected>Select Barangay</option>
                            <option value="Agupalo Este">Agupalo Este</option>
                            <option value="Agupalo Weste">Agupalo Weste</option>
                            <option value="Alalay Chica">Alalay Chica</option>
                            <option value="Alalay Grande">Alalay Grande</option>
                            <option value="Bagong Flores">Bagong Flores</option>
                            <option value="Balbalungao">Balbalungao</option>
                            <option value="Burgos">Burgos</option>
                            <option value="Cordero">Cordero</option>
                            <option value="J.U. Tienzo">J.U. Tienzo</option>
                            <option value="Mapangpang">Mapangpang</option>
                            <option value="Namulandayan">Namulandayan</option>
                            <option value="Parista">Parista</option>
                            <option value="Poblacion East">Poblacion East</option>
                            <option value="Poblacion North">Poblacion North</option>
                            <option value="Poblacion South">Poblacion South</option>
                            <option value="Poblacion West">Poblacion West</option>
                            <option value="Salvacion I">Salvacion I</option>
                            <option value="Salvacion II">Salvacion II</option>
                            <option value="San Antonio Este">San Antonio Este</option>
                            <option value="San Antonio Weste">San Antonio Weste</option>
                            <option value="San Isidro">San Isidro</option>
                            <option value="San Pedro">San Pedro</option>
                            <option value="San Roque">San Roque</option>
                            <option value="Santo Domingo">Santo Domingo</option>
                            <!-- Add more options as needed -->
                        </select>

                        <input type="text" id="contact_no" name="contact_no" placeholder="Contact Number" placeholder="Birthdate" required>

                        <label for="date">Birthdate:</label>
                        <input type="date" id="birthdate" name="birthdate" required>

                        <!-- Gender -->
                        <label for="gender">Gender:</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>

                        <label for="gov_id">Upload Any Government ID:</label>
                        <input type="file" id="gov_id" name="gov_id" accept="image/*" required>

                        <div id="documents-section" style="display: none;">
                            <label for="psa">Upload PSA:</label>
                            <input type="file" id="psa" name="psa">

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

        document.getElementById('birthdate').addEventListener('change', function() {
            const birthdateInput = new Date(this.value);
            const today = new Date();

            // Calculate the difference in years
            const age = today.getFullYear() - birthdateInput.getFullYear();
            const monthDiff = today.getMonth() - birthdateInput.getMonth();
            const dayDiff = today.getDate() - birthdateInput.getDate();

            // Adjust age if the birthdate's month/day hasn't occurred yet this year
            const adjustedAge = monthDiff > 0 || (monthDiff === 0 && dayDiff >= 0) ? age : age - 1;

            if (adjustedAge < 15 || birthdateInput.getFullYear() === today.getFullYear()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Birthdate',
                    text: 'Your birthdate indicates that you are younger than 15 years old or it is set to the current year. Please select a valid birthdate make sure that you must be 15 years old and above.',
                    confirmButtonText: 'OK'
                });

                // Clear the input
                this.value = '';
            }
        });

        document.getElementById('gov_id').addEventListener('change', function() {
            var file = this.files[0]; // Get the selected file

            // Check if a file is selected and validate its type
            if (file) {
                var fileType = file.type;
                var validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

                if (!validImageTypes.includes(fileType)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type',
                        text: 'Please upload an image file (JPEG, PNG, GIF).',
                        confirmButtonText: 'OK'
                    });
                    // Clear the file input if the file type is not valid
                    this.value = '';
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#user_type').on('change', function() {
                var user_type = $(this).val();

                if (user_type == 2) {
                    $('#documents-section').show(); // Show document upload section
                } else {
                    $('#documents-section').hide(); // Hide if not user_type 2
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