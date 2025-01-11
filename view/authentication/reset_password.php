<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupao - Scholarship and Employment Portal</title>
    <link rel="icon" href="../../assets/img/Lupao_Nueva_Ecija_seal_logo.png">
    <link rel="stylesheet" href="../../assets/css/loginstyle.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<input type="hidden" id="reset_token" name="reset_token" value="<?php echo htmlspecialchars($_GET['token']); ?>">

<div class="container">
    <div class="left-section">
        <div class="logo-container">
            <img src="../../assets/img/admin.png" alt="Logo">
        </div>
    </div>

    <div class="right-section">
        <div class="form-container">

            <div id="reset-password-form">
                <h2>Reset Password</h2>
                <form id="reset-password-form" class="reset_password_form" action="#" method="POST">
                    <div id="response"></div>
                    <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                    <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder="Confirm Password" required>

                    <button type="submit">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/script.js"></script>

<script>
    $(document).ready(function () {
        $('.reset_password_form').on('submit', function(e) {
            e.preventDefault();

            // Show the "Submitting. Please Wait" alert
            const loadingAlert = Swal.fire({
                title: 'Submitting. Please Wait',
                text: 'Password is being reset.',
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false, // Prevent closing while processing
                showConfirmButton: false // Hide the confirm button
            });

            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_new_password').val();
            var reset_token = $('#reset_token').val();

            // Check if passwords match
            if (new_password !== confirm_password) {
                Swal.fire({
                    icon: 'error',
                    title: 'Passwords Do Not Match',
                    text: 'Please make sure both passwords match.',
                    confirmButtonText: 'OK'
                });
                loadingAlert.close(); // Close the loading alert
                return;
            }

            $.ajax({
                type: 'POST',
                url: '../../controllers/authenticationController.php',
                data: {
                    reset_password: true,
                    reset_token: reset_token,
                    new_password: new_password,
                },
                success: function(response) {
                    try {
                        response = JSON.parse(response);
                        loadingAlert.close(); // Close the loading alert

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Password Reset Successful, You can now Login!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to login page after user confirms
                                    window.location.href = '../../view/authentication/login.php';
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Password Reset Failed',
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
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error);
                    loadingAlert.close(); // Close the loading alert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>

</body>
</html>
