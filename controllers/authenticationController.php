<?php

session_start();

require "../db/dbconfig.php";
require "../vendor/autoload.php"; // Include Composer's autoload for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require '../phpmailer/src/Exception.php';
// require '../phpmailer/src/PHPMailer.php';
// require '../phpmailer/src/SMTP.php';


$db = new DB();

if (isset($_POST['signup_user'])) {

    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : "";
    $firstname = isset($_POST['register-firstname']) ? $_POST['register-firstname'] : "";
    $lastname = isset($_POST['register-lastname']) ? $_POST['register-lastname'] : "";
    $email = isset($_POST['register-email']) ? $_POST['register-email'] : "";
    $password = isset($_POST['register-password']) ? $_POST['register-password'] : "";
    $barangay = isset($_POST['barangay']) ? $_POST['barangay'] : "";
    $contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : "";
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : "";
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";

    $base_upload_dir = 'uploads';
    
    $subdirs = [
        'psa' => 'uploads/psa',
        'gov_id' => 'uploads/gov_id',
        'business_permit' => 'uploads/business_permit',
        'cedula' => 'uploads/cedula',
    ];

    foreach ($subdirs as $subdir) {
        if (!is_dir($subdir)) {
            mkdir($subdir, 0777, true);
        }
    }


    $file_uploads = ['psa', 'gov_id', 'business_permit', 'cedula'];
    $file_paths = [];

    foreach ($file_uploads as $file_input) {
        if (isset($_FILES[$file_input]) && $_FILES[$file_input]['error'] == 0) {
            $tmp_name = $_FILES[$file_input]['tmp_name'];
            $name = basename($_FILES[$file_input]['name']);
            $file_path = "{$subdirs[$file_input]}/$name"; 

            if (move_uploaded_file($tmp_name, $file_path)) {
                $file_paths[$file_input] = $file_path; 
            } else {
                echo json_encode(['success' => false, 'message' => "Failed to upload $file_input."]);
                exit;
            }
        }
    }

    $signup_result = $db->user_signup($user_type, $firstname, $lastname, $email, $password, $barangay, $contact_no, $birthdate, $gender, $file_paths);

    // tdjt jnjc btxf fwls
    
    if($signup_result === true)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                       
            $mail->Host = 'smtp.gmail.com';                      
            $mail->SMTPAuth = true;                                      
            $mail->Username = 'lupaoportal@gmail.com';            
            $mail->Password = 'tdjtjnjcbtxffwls';                     
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       
            $mail->Port = 587;                                         

            // Recipients
            $mail->setFrom('lupaoportal@gmail.com', 'Lupao Employment & Scholarship');
            $mail->addAddress($email);                              

            // Content
            $mail->isHTML(true);                                   
            $mail->Subject = 'Registration Success - Account Activation Pending';
            $mail->Body    = "
                <p>Hi $firstname $lastname,</p>
                <p>Your registration was successful! Please wait for your account to be activated by our team. We will notify you once your account is ready to use.</p>
                <p>Best regards,<br>Lupao LGU</p>
            ";

            // Send the email
            $mail->send();
            echo json_encode(['success' => true, 'message' => 'Registration Success! Wait for your account to be activated and email notification sent.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Registration succeeded, but email could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
        }

        // echo json_encode(['success' => true, 'message' => 'Registration Success! Wait for your account to be activated.']);

    } elseif ($signup_result === false)
    {
        echo json_encode(['success' => false, 'message' => 'Email already used. Use another email']);

    } else
    {
        echo json_encode(['success' => false, 'message' => 'Registration failed. Please try again later.']);

    }
}

// LOGIN ADMIN
if (isset($_POST['logged_user'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    // echo json_encode([
    //     'email' => $email,
    //     'password' => $password,
    // ]);

    // exit;

    $login_result = $db->login_user($email, $password);

    if ($login_result === 'not_activated') {
        // Account not activated
        echo json_encode(['success' => false, 'message' => 'Account Still not Activated']);
        
    } elseif($login_result === 'not_found') {

        echo json_encode(['success' => false, 'message' => 'Account not found. Please register first.']);

    } elseif ($login_result) {

        $id = $login_result['id']; // Get faculty ID
        $firstname = $login_result['firstname'];
        $lastname = $login_result['lastname'];
        $email = $login_result['email'];
        $role = trim($login_result['role']); // Convert role to lowercase and trim any whitespace

        $_SESSION['id'] = $id; // Store faculty ID in session
        $_SESSION['logged_in'] = true;
        $_SESSION['firstname'] = $firstname; // Store first name in session
        $_SESSION['lastname'] = $lastname;   // Optionally store last name or other data
        $_SESSION['email'] = $email;   // Optionally store last name or other data
        $_SESSION['role'] = $role;
      
        // Redirect based on role
        switch (strtolower($role)) {
            case 'admin':
                $redirect = './view/admin-side/admin.index.php'; // Admin side
                break;
            case 'employer':
                $redirect = './view/employer-side/employer.index.php'; // Employer side
                break;
            case 'applicant':
                $redirect = './view/applicant-side/applicant.index.php'; // applicant side
                break;
            default:
                $redirect = './index.php'; // Default fallback
                break;
        }

        // Set timezone
        $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
        $date = new DateTime('now', $timezone); // Get the current time in that timezone
        $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'
        $timeAt = $date->format('H:i:s');

        // Log the login activity using the insert method
        $activity_data = [
            'user_id' => $id,
            'activity_name' => 'Logged In',
            'date' => $createdAt,
            'time' => $timeAt,
        ];

        $db->insert('activity_log', $activity_data);

        // Prepare JSON response
        $response = [
            'success' => true,
            'redirect' => $redirect,
            'id' => $id,
            'role' => $role,
            'firstname' => $firstname,
            'lastname' => $lastname
        ];

        echo json_encode($response);
    } else {
        // Admin login failed, show an error message or redirect as needed
        echo json_encode(['success' => false, 'message' => 'Login failed. Check your username and password.']);
    }
}

// Function to generate a unique token
function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

// Function to send reset email
function sendResetEmail($email, $token) {
    $mail = new PHPMailer(true);

    try {
        // Determine the base URL dynamically
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST']; // Get the host (e.g., example.com or localhost)
        $path = '/view/authentication/reset_password.php'; // Path to your reset_password.php
        $resetLink = $protocol . $host . $path . '?token=' . $token;

        // Server settings
        $mail->isSMTP();                                           
        $mail->Host = 'smtp.gmail.com';                            
        $mail->SMTPAuth = true;                                    
        $mail->Username = 'lupaoportal@gmail.com';                 
        $mail->Password = 'tdjtjnjcbtxffwls';                     
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port = 587;                                         

        // Recipients
        $mail->setFrom('lupaoportal@gmail.com', 'Lupao Employment & Scholarship');
        $mail->addAddress($email);                                   

        // Content
        $mail->isHTML(true);                                       
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "
            <p>Hi,</p>
            <p>We received a request to reset your password. Click the link below to create a new password:</p>
            <p><a href='$resetLink'>Reset Password</a></p>
            <p>If you did not request a password reset, please ignore this email.</p>
            <p>Best regards,<br>Lupao LGU</p>
        ";

        // Send the email
        $mail->send();
        return ['success' => true, 'message' => 'Password reset email sent.'];
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo];
    }
}



// FORGOT PASSWORD
if (isset($_POST['forgot_password'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : "";

    // Check if the email exists
    $user = $db->getUserByEmail($email);

    if ($user) {
        $token = generateToken();
        $expires = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token valid for 1 hour

        // Store the token and expiration in the database
        $update_result = $db->storePasswordResetToken($email, $token, $expires);

        if ($update_result) {
            $email_result = sendResetEmail($email, $token);
            echo json_encode($email_result);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error storing reset token.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found.']);
    }
}

// RESET PASSWORD
if (isset($_POST['reset_password'])) {
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : "";
    $token = isset($_POST['reset_token']) ? $_POST['reset_token'] : "";

    if (!empty($new_password) && !empty($token)) {

        $token_data = $db->getTokenData($token);

        if ($token_data && $token_data['expires'] > date("Y-m-d H:i:s")) {

            if (strlen($new_password) >= 8) { // Example validation
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                // Update the password and invalidate the token
                $update_result = $db->updatePassword($token_data['email'], $hashed_password);

                if ($update_result) {
                    // Invalidate the token
                    $db->invalidateToken($token);

                    echo json_encode(['success' => true, 'message' => 'Password successfully reset.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error updating password.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Password does not meet security requirements.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid or expired token.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    }
}
