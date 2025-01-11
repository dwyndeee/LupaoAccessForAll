if (isset($_POST['action'])) {
    try {
        $action = $_POST['action'];

        error_log("Action received: " . $action);

        $id = isset($_POST['jobApplicationId']) ? $_POST['jobApplicationId'] : "";
        $email = isset($_POST['applicantEmail']) ? $_POST['applicantEmail'] : "";

        // New data to send in the email
        $applicantName = isset($_POST['applicantName']) ? $_POST['applicantName'] : "";
        $company = isset($_POST['company']) ? $_POST['company'] : "";
        $position = isset($_POST['position']) ? $_POST['position'] : "";
        $salary = isset($_POST['salary']) ? $_POST['salary'] : "";
        $applied_on = isset($_POST['applied_on']) ? $_POST['applied_on'] : "";
        
        if (!empty($id) && !empty($email)) {
            // Define the data array to update the status
            $data = [];
            $message = '';

            if ($action === 'acceptJobApplication') {
                $data['status'] = 1; // Adjust as per your database representation
                $data['date_approved'] = date('Y-m-d'); // Format: YYYY-MM-DD
                $message = 'Job Application Approval Success';
                $emailSubject = 'Job Application Status';
                $emailBody = "I hope this email finds you well. We appreciate your interest in applying for $position on $company with a salar of $salary.
                Upon reviewing your application submitted on $applied_on. Our acquisition team decided to move forward your application to the second phase
                of our hiring process. Please wait for further instructions.";
            } elseif ($action === 'rejectJobApplication') {
                $data['status'] = 0; // Adjust as per your database representation
                $data['date_approved'] = date('Y-m-d'); // Format: YYYY-MM-DD
                $message = 'Job Application rejected successfully.';
                $emailSubject = 'Job Application Status';
                $emailBody = "I hope this email finds you well. We appreciate your interest in applying for $position on $company with a salar of $salary.
                Upon reviewing your application submitted on $applied_on. Our acquisition team decided not to continue your application. Do not be discourage
                there might be other job opportunities for you, just stay tune on our announcements!";
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid action specified.']);
                exit;
            }

            // Update the scholarship status in the database
            $where = ['id' => $id];
            if ($db->update('employment_job_applications', $data, $where)) {
                // Send email notification
                $mail = new PHPMailer(true);
                $mail->isSMTP();                                     
                $mail->Host = 'smtp.gmail.com';                      
                $mail->SMTPAuth = true;                              
                $mail->Username = 'lupaoportal@gmail.com';            
                $mail->Password = 'tdjtjnjcbtxffwls';                  
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
                $mail->Port = 587;                                   

                // Set the sender
                $mail->setFrom('lupaoportal@gmail.com', 'Lupao Employment & Scholarship');
                
                // Recipients
                $mail->addAddress($email); // Use the email provided

                // Content
                $mail->isHTML(true);
                $mail->Subject = $emailSubject;
                $mail->Body = $emailBody;

                // Send the email
                if ($mail->send()) {
                    $_SESSION['success'] = $message;
                    echo json_encode(['success' => true, 'message' => $message]);
                } else {
                    $_SESSION['failed'] = 'Email could not be sent. Please try again';
                    echo json_encode(['success' => false, 'message' => 'Job Application update succeeded, but email notification failed.']);
                }
            } else {
                $_SESSION['failed'] = 'Update failed. Please try again';
                echo json_encode(['success' => false, 'message' => 'Job Application update failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please provide a valid Job Application ID and email.']);
        }

    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while processing the request.']);
    }
}