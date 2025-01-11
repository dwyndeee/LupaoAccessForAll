<?php

session_start();

require "../db/dbconfig.php";
require "../vendor/autoload.php"; // Include Composer's autoload for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$db = new DB();

if (isset($_POST['applyJob'])) {
    $jobId = $_POST['jobId'];
    $applicantId = $_POST['applicantId'];
    $applicantEmail = $_POST['applicantEmail'];
    
    // Handle file uploads
    $uploadsDir = '../uploads/jobs/';

    $requirement1Dir = $uploadsDir . 'requirements_1/';
    $requirement2Dir = $uploadsDir . 'requirements_2/';
    $requirement3Dir = $uploadsDir . 'requirements_3/';
    $requirement4Dir = $uploadsDir . 'requirements_4/';
    
    // Create subdirectories if they don't exist
    if (!is_dir($requirement1Dir)) mkdir($requirement1Dir, 0777, true);
    if (!is_dir($requirement2Dir)) mkdir($requirement2Dir, 0777, true);
    if (!is_dir($requirement3Dir)) mkdir($requirement3Dir, 0777, true);
    if (!is_dir($requirement4Dir)) mkdir($requirement4Dir, 0777, true);

    $requirement_1 = $_FILES['requirement_1']['name'];
    $requirement_2 = $_FILES['requirement_2']['name'];
    $requirement_3 = $_FILES['requirement_3']['name'];
    $requirement_4 = $_FILES['requirement_4']['name'];

    // Move uploaded files to the server
    move_uploaded_file($_FILES['requirement_1']['tmp_name'], $requirement1Dir  . $requirement_1);
    if (!empty($requirement_2)) {
        move_uploaded_file($_FILES['requirement_2']['tmp_name'], $requirement2Dir  . $requirement_2);
    }
    if (!empty($requirement_3)) {
        move_uploaded_file($_FILES['requirement_3']['tmp_name'], $requirement3Dir  . $requirement_3);
    }
    if (!empty($requirement_4)) {
        move_uploaded_file($_FILES['requirement_4']['tmp_name'], $requirement4Dir  . $requirement_4);
    }

    // Prepare data for inserting into the database
    $data = [
        'job_id' => $jobId,
        'applicant_id' => $applicantId,
        'requirement_1' => 'requirements_1/' . $requirement_1,
        'requirement_2' => 'requirements_2/' . $requirement_2,
        'requirement_3' => 'requirements_3/' . $requirement_3,
        'requirement_4' => 'requirements_4/' . $requirement_4,
        'applied_on' => date('Y-m-d H:i:s'),
    ];

    // Insert data into the database
    if ($db->insert('employment_job_applications', $data)) {
        // Send confirmation email to the applicant
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

            // Recipient settings
            $mail->setFrom('lupaoportal@gmail.com', 'Lupao Employment & Scholarship');
            $mail->addAddress($applicantEmail); // Replace with the applicant's email

            // Content settings
            $mail->isHTML(true);
            $mail->Subject = 'Job Application Submitted';
            $mail->Body = 'Thank you for applying for the job. We will review your application and get back to you soon.';

            // Send the email
            $mail->send();
            
            echo json_encode(['success' => true, 'message' => 'Application submitted successfully.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Application submitted but email could not be sent.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to submit the application.']);
    }
}

if (isset($_POST['applyScholar'])) {
    $programId = $_POST['scholarshipId'];
    $applicantId = $_POST['schoApplicantId'];
    $applicantEmail = $_POST['schoApplicantEmail'];
    
    // Handle file uploads
    $uploadsDir = '../uploads/programs/';

    $requirement1Dir = $uploadsDir . 'requirements_1/';
    $requirement2Dir = $uploadsDir . 'requirements_2/';
    $requirement3Dir = $uploadsDir . 'requirements_3/';
    $requirement4Dir = $uploadsDir . 'requirements_4/';
    
    // Create subdirectories if they don't exist
    if (!is_dir($requirement1Dir)) mkdir($requirement1Dir, 0777, true);
    if (!is_dir($requirement2Dir)) mkdir($requirement2Dir, 0777, true);
    if (!is_dir($requirement3Dir)) mkdir($requirement3Dir, 0777, true);
    if (!is_dir($requirement4Dir)) mkdir($requirement4Dir, 0777, true);

    $requirement_1 = $_FILES['requirement_1']['name'];
    $requirement_2 = $_FILES['requirement_2']['name'];
    $requirement_3 = $_FILES['requirement_3']['name'];
    $requirement_4 = $_FILES['requirement_4']['name'];

    // Move uploaded files to the server
    move_uploaded_file($_FILES['requirement_1']['tmp_name'], $requirement1Dir  . $requirement_1);
    if (!empty($requirement_2)) {
        move_uploaded_file($_FILES['requirement_2']['tmp_name'], $requirement2Dir  . $requirement_2);
    }
    if (!empty($requirement_3)) {
        move_uploaded_file($_FILES['requirement_3']['tmp_name'], $requirement3Dir  . $requirement_3);
    }
    if (!empty($requirement_4)) {
        move_uploaded_file($_FILES['requirement_4']['tmp_name'], $requirement4Dir  . $requirement_4);
    }

    // Prepare data for inserting into the database
    $data = [
        'program_id' => $programId,
        'student_id' => $applicantId,
        'requirement_1' => 'requirements_1/' . $requirement_1,
        'requirement_2' => 'requirements_2/' . $requirement_2,
        'requirement_3' => 'requirements_3/' . $requirement_3,
        'requirement_4' => 'requirements_4/' . $requirement_4,
        'date_applied' => date('Y-m-d H:i:s'),
    ];

    // Insert data into the database
    if ($db->insert('scholarships_scholars', $data)) {
        // Send confirmation email to the applicant
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

            // Recipient settings
            $mail->setFrom('lupaoportal@gmail.com', 'Lupao Employment & Scholarship');
            $mail->addAddress($applicantEmail); // Replace with the applicant's email

            // Content settings
            $mail->isHTML(true);
            $mail->Subject = 'Sacholarship Application Submitted';
            $mail->Body = 'Thank you for applying for the job. We will review your application and get back to you soon.';

            // Send the email
            $mail->send();
            
            echo json_encode(['success' => true, 'message' => 'Application submitted successfully.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Application submitted but email could not be sent.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to submit the application.']);
    }
}

if(isset($_POST['getUserPendingJobApplications'])) {

    $applicant_id = isset($_POST['applicant_id']) ? $_POST['applicant_id'] : "";
    
    try {
        $pendingUserJobApplicationsData = $db->getUserPendingJobApplications($applicant_id);

        if ($pendingUserJobApplicationsData !== FALSE) {
            echo json_encode(['success' => TRUE, 'pendingUserJobApplicationsData' => $pendingUserJobApplicationsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Jobs Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if(isset($_POST['getUserSchoApplication'])) {

    $applicant_id = isset($_POST['applicant_id']) ? $_POST['applicant_id'] : "";
    
    try {
        $pendingUserScholar = $db->getUserScholarPending($applicant_id);

        if ($pendingUserScholar !== FALSE) {
            echo json_encode(['success' => TRUE, 'pendingUserScholar' => $pendingUserScholar]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Scholarship Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}
