<?php

session_start();

require "../db/dbconfig.php";

require "../vendor/autoload.php"; // Include Composer's autoload for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$db = new DB();
// 
// if (isset($_POST['getAllScholarshipPrograms'])) {
//     try {
//         $scholarshipProgramsData = $db->getAllScholarshipPrograms();

//         if ($scholarshipProgramsData !== FALSE) {
//             echo json_encode(['success' => TRUE, 'scholarshipProgramsData' => $scholarshipProgramsData]);
//         } else {
//             echo json_encode(['success' => FALSE, 'message' => 'No Scholarship Program Found']);
//         }
//     } catch (Exception $e) {
//         // Log error and output JSON response
//         error_log($e->getMessage());
//         echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
//     }
// }
if (isset($_POST['getAllScholarshipPrograms'])) {
    try {
        $scholarshipProgramsData = $db->getAllScholarshipPrograms();

        if ($scholarshipProgramsData !== FALSE) {
            $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;

            // If the user is logged in, check if they have applied for any scholarships
            if ($userId) {
                foreach ($scholarshipProgramsData as &$program) {
                    // Check if the user has applied for this scholarship program
                    $isApplied = $db->isUserAppliedForScholarship($userId, $program['id']);
                    $program['isApplied'] = $isApplied;
                }
            }

            echo json_encode(['success' => TRUE, 'scholarshipProgramsData' => $scholarshipProgramsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Scholarship Program Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}


if (isset($_POST['addScholarshipProgram'])) {
    try {
        $grantor = $_POST['grantor'] ?? "";
        $program_title = $_POST['program_title'] ?? "";
        $description = $_POST['description'] ?? "";
        $beneficiaries = $_POST['beneficiaries'] ?? "";
        $requirements = $_POST['requirements'] ?? "";
        $application_start = $_POST['application_start'] ?? "";
        $application_deadline = $_POST['application_deadline'] ?? "";
        $slot = filter_var($_POST['slot'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
        $status = filter_var($_POST['status'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 1]]);

        if (!$slot || $status === false) {
            echo json_encode(['success' => false, 'message' => 'Invalid input for slots or status.']);
            exit;
        }

        $startDate = DateTime::createFromFormat('Y-m-d', $application_start);
        $endDate = DateTime::createFromFormat('Y-m-d', $application_deadline);

        if (!$startDate || !$endDate || $startDate > $endDate) {
            echo json_encode(['success' => false, 'message' => 'Invalid application dates.']);
            exit;
        }

        $data = [
            'grantor' => $grantor,
            'program_title' => $program_title,
            'description' => $description,
            'beneficiaries' => $beneficiaries,
            'requirements' => $requirements,
            'application_start' => $application_start,
            'application_deadline' => $application_deadline,
            'slot' => $slot,
            'status' => $status
        ];

        $timezone = new DateTimeZone('Asia/Manila');
        $createdAt = (new DateTime('now', $timezone))->format('Y-m-d H:i:s');

        if ($db->insert('scholarship_programs', $data)) {
            $activity_log_data = [
                'user_id' => $_SESSION['id'],
                'activity_name' => "Added scholarship program $program_title",
                'date' => $createdAt
            ];
            $db->insert('activity_log', $activity_log_data);

            echo json_encode(['success' => true, 'message' => 'Scholarship program added successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Creation failed.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred.']);
    }
}


if (isset($_POST['updateScholarshipProgram'])) {

    try {
        // Collecting form data
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $grantor = isset($_POST['updateGrantor']) ? $_POST['updateGrantor'] : "";
        $program_title = isset($_POST['updateProgram_title']) ? $_POST['updateProgram_title'] : "";
        $description = isset($_POST['updateDescription']) ? $_POST['updateDescription'] : "";
        $beneficiaries = isset($_POST['updateBeneficiaries']) ? $_POST['updateBeneficiaries'] : "";
        $requirements = isset($_POST['updateRequirements']) ? $_POST['updateRequirements'] : "";
        $application_start = isset($_POST['updateApplication_start']) ? $_POST['updateApplication_start'] : "";
        $application_deadline = isset($_POST['updateApplication_deadline']) ? $_POST['updateApplication_deadline'] : "";
        $slot = isset($_POST['updateSlot']) ? $_POST['updateSlot'] : "";
        $status = isset($_POST['updateStatus']) ? $_POST['updateStatus'] : "";

        // Validate the inputs
        if (
            !empty($id) && !empty($grantor) && !empty($program_title) && !empty($description) && !empty($beneficiaries) && !empty($requirements) &&
            !empty($application_start) && !empty($application_deadline) && !empty($slot) && isset($status)
        ) {

            // Ensure proper format for dates and numeric values
            if (
                DateTime::createFromFormat('Y-m-d', $application_start) && DateTime::createFromFormat('Y-m-d', $application_deadline) &&
                is_numeric($slot) && intval($slot) > 0 && ($status == 0 || $status == 1)
            ) {

                // Prepare data for update
                $data = [
                    'grantor' => $grantor,
                    'program_title' => $program_title,
                    'description' => $description,
                    'beneficiaries' => $beneficiaries,
                    'requirements' => $requirements,
                    'application_start' => $application_start,
                    'application_deadline' => $application_deadline,
                    'slot' => $slot,
                    'status' => $status
                ];

                // WHERE clause to update the specific program
                $where = ['id' => $id];
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                // Attempt to update data in the database
                if ($db->update('scholarship_programs', $data, $where)) {

                    $activity_log_data = [
                        'user_id' => $_SESSION['id'], // Assuming user ID is stored in session
                        'activity_name' => "Edited scholarship program $program_title", // Activity name
                        'date' => $createdAt // Current timestamp
                    ];

                    // Insert the activity log
                    $db->insert('activity_log', $activity_log_data);

                    $_SESSION['success'] = 'Scholarship program updated successfully';
                    echo json_encode(['success' => true, 'message' => 'Scholarship program updated successfully.']);
                } else {
                    $_SESSION['failed'] = 'Update failed. Please try again';
                    echo json_encode(['success' => false, 'message' => 'Scholarship program update failed.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid data format. Please check dates and slot.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please provide all the required details.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while updating the program.']);
    }
}

if (isset($_POST['deleteScholarshipProgram'])) {
    try {

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $program_title = isset($_POST['program_title']) ? $_POST['program_title'] : "";

        if ($id > 0) {

            $where = ['id' => $id];
            // Set timezone
            $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
            $date = new DateTime('now', $timezone); // Get the current time in that timezone
            $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

            if ($db->delete('scholarship_programs', $where)) {

                $activity_log_data = [
                    'user_id' => $_SESSION['id'], // Assuming user ID is stored in session
                    'activity_name' => "Deleted scholarship program $program_title", // Activity name
                    'date' => $createdAt // Current timestamp
                ];

                // Insert the activity log
                $db->insert('activity_log', $activity_log_data);

                $_SESSION['success'] = 'Scholarship program deleted successfully';
                echo json_encode(['success' => true, 'message' => 'Scholarship program deleted successfully.']);
            } else {
                $_SESSION['failed'] = 'Delete failed. Please try again';
                echo json_encode(['success' => false, 'message' => 'Scholarship program deletion failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID provided.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while deleting the program.']);
    }
}

if (isset($_POST['getAllScholar'])) {

    try {
        $scholarsData = $db->getAllScholar();

        if ($scholarsData !== FALSE) {
            echo json_encode(['success' => TRUE, 'scholarsData' => $scholarsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Scholars Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['getAllScholarPending'])) {

    try {
        $pendingScholarsData = $db->getAllScholarPending();

        if ($pendingScholarsData !== FALSE) {
            echo json_encode(['success' => TRUE, 'pendingScholarsData' => $pendingScholarsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Pending Scholars Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['getAllScholarRejected'])) {

    try {
        $rejectedScholarsData = $db->getAllScholarRejected();

        if ($rejectedScholarsData !== FALSE) {
            echo json_encode(['success' => TRUE, 'rejectedScholarsData' => $rejectedScholarsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Pending Scholars Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['getAllScholarEmail'])) {

    $program_id = isset($_POST['scholarshipProgramId']) ? $_POST['scholarshipProgramId'] : "";

    try {
        // Pass the program_id to the function
        $scholarsEmailData = $db->getAllScholarEmailOnProgram($program_id);

        if ($scholarsEmailData !== FALSE && !empty($scholarsEmailData)) {
            echo json_encode(['success' => TRUE, 'scholarsEmailData' => $scholarsEmailData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Scholars Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['notifyScholars'])) {
    $program_id = isset($_POST['scholarshipProgramId']) ? $_POST['scholarshipProgramId'] : "";
    $program_title = isset($_POST['scholarshipProgramTitle']) ? $_POST['scholarshipProgramTitle'] : "";
    $message_header = isset($_POST['message_header']) ? $_POST['message_header'] : "";
    $message_body = isset($_POST['message_body']) ? $_POST['message_body'] : "";

    try {
        // Initialize the flag
        $allEmailsSent = true;

        // Get the email addresses of scholars
        $scholarsEmailData = $db->getAllScholarEmailOnProgram($program_id);

        if ($scholarsEmailData !== FALSE && !empty($scholarsEmailData)) {
            // Initialize PHPMailer
            $mail = new PHPMailer(true);
            // Configure PHPMailer settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'lupaoportal@gmail.com';
            $mail->Password = 'tdjtjnjcbtxffwls';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Set the sender
            $mail->setFrom('lupaoportal@gmail.com', 'Lupao Employment & Scholarship');

            foreach ($scholarsEmailData as $scholar) {
                // Recipients
                $mail->addAddress($scholar['email']); // Use email from $scholar

                // Content
                $mail->isHTML(true);
                $mail->Subject = $message_header;
                $mail->Body = $message_body;

                // Send the email
                if (!$mail->send()) {
                    $allEmailsSent = false;
                }
                $mail->clearAddresses();
            }

            if ($allEmailsSent) {
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                $activity_log_data = [
                    'user_id' => $_SESSION['id'], // Assuming user ID is stored in session
                    'activity_name' => "Notified Scholars from $program_title", // Activity name
                    'date' => $createdAt // Current timestamp
                ];

                // Insert the activity log
                $db->insert('activity_log', $activity_log_data);

                echo json_encode(['success' => TRUE, 'message' => 'Notifications sent successfully.']);
            } else {
                echo json_encode(['success' => FALSE, 'message' => 'Some emails could not be sent.']);
            }
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Scholars Found']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while sending notifications.']);
    }
}

if (isset($_POST['updateScholarRemarks'])) {
    try {
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $program_id = isset($_POST['updateProgramId']) ? $_POST['updateProgramId'] : "";
        $student_id = isset($_POST['updateStudentId']) ? $_POST['updateStudentId'] : "";
        $student_name = isset($_POST['updateStudentName']) ? $_POST['updateStudentName'] : "";
        $program_title = isset($_POST['updateProgram_title']) ? $_POST['updateProgram_title'] : "";
        $status = isset($_POST['updateStatus']) && $_POST['updateStatus'] !== '' ? $_POST['updateStatus'] : null;

        error_log("id: $id, program_id: $program_id, student_id: $student_id, program_title: $program_title, status: $status");

        if (!empty($id) && !empty($program_id) && !empty($student_id) && !empty($program_title)) {

            $data = [
                'status' => $status,
            ];

            $where = ['id' => $id, 'program_id' => $program_id, 'student_id' => $student_id];

            if ($db->update('scholarships_scholars', $data, $where)) {
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                $activity_log_data = [
                    'user_id' => $_SESSION['id'], // Assuming user ID is stored in session
                    'activity_name' => "Changed $student_name status and remarks from program $program_title", // Activity name
                    'date' => $createdAt // Current timestamp
                ];

                // Insert the activity log
                $db->insert('activity_log', $activity_log_data);

                $_SESSION['success'] = 'Scholarship program updated successfully';
                echo json_encode(['success' => true, 'message' => 'Scholarship program updated successfully.']);
            } else {
                $_SESSION['failed'] = 'Update failed. Please try again';
                echo json_encode(['success' => false, 'message' => 'Scholarship program update failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please provide all the required details.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while updating the program.']);
    }
}

if (isset($_POST['action'])) {
    try {
        $action = $_POST['action'];
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $program_id = isset($_POST['program_id']) ? $_POST['program_id'] : "";

        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : "";

        // New data to send in the email
        $student_name = isset($_POST['student_name']) ? $_POST['student_name'] : "";
        $grantor = isset($_POST['grantor']) ? $_POST['grantor'] : "";
        $program_title = isset($_POST['program_title']) ? $_POST['program_title'] : "";

        if (!empty($id) && !empty($email)) {
            // Define the data array to update the status
            $data = [];
            $message = '';

            if ($action === 'acceptScholarship') {
                $data['status'] = 1; // Adjust as per your database representation
                $data['date_approved'] = date('Y-m-d'); // Format: YYYY-MM-DD
                $message = 'Scholarship application accepted successfully.';
                $act = 'accepted';
                $emailSubject = 'Scholarship Application Status';
                $emailBody = "I hope this email finds you well. We are here to congratulate $student_name on your application from $grantor's $program_title this " . date('F j, Y') . ".";
                $smsMessage = "Congratulations $student_name! Your application for $grantor's $program_title has been accepted.";
            } elseif ($action === 'rejectScholarship') {
                $data['status'] = 0; // Adjust as per your database representation
                $data['date_approved'] = date('Y-m-d'); // Format: YYYY-MM-DD
                $message = 'Scholarship application rejected successfully.';
                $act = 'rejected';
                $emailSubject = 'Scholarship Application Status';
                $emailBody = "I hope this email finds you well. We are here to inform $student_name that your application for $grantor's $program_title is rejected. We hope to hear from you again soon.";
                $smsMessage = "Hello $student_name, your application for $grantor's $program_title has been rejected. Better luck next time.";
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid action specified.']);
                exit;
            }

            // Update the scholarship status in the database
            $where = ['id' => $id];
            $where_program_id = ['id' => $program_id];
            // Fetch the current value of `slot`
            $slotQuery = "SELECT slot FROM scholarship_programs WHERE id = ?";
            $currentSlotResult = $db->select($slotQuery, [$program_id]);

            // Check if a result was returned
            if ($currentSlotResult && $currentSlotRow = $currentSlotResult->fetch_assoc()) {
                $currentSlot = (int)$currentSlotRow['slot']; // Get the current slot value and cast to int
                $newSlot = $currentSlot - 1; // Decrement the slot value
                if (
                    $db->update('scholarships_scholars', $data, $where) &&
                    $db->update('scholarship_programs', ['slot' => $newSlot], $where_program_id)
                ) {


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

                        // Log activity
                        $user_id = $_SESSION['id']; // Assuming user ID is stored in session
                        // Set timezone
                        $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                        $date = new DateTime('now', $timezone); // Get the current time in that timezone
                        $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                        $activity_log_data = [
                            'user_id' => $user_id, // User performing the action
                            'activity_name' => "Scholarship for $student_name ($program_title) was $act", // Activity name based on action
                            'date' => $createdAt // Current timestamp
                        ];

                        // Insert into activity log
                        $db->insert('activity_log', $activity_log_data); // Insert activity log

                        $_SESSION['success'] = $message;
                        echo json_encode(['success' => true, 'message' => $message]);
                    } else {
                        $_SESSION['failed'] = 'Email could not be sent. Please try again';
                        echo json_encode(['success' => false, 'message' => 'Scholarship application update succeeded, but email notification failed.']);
                    }
                } else {
                    $_SESSION['failed'] = 'Update failed. Please try again';
                    echo json_encode(['success' => false, 'message' => 'Scholarship application update failed.']);
                }
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please provide a valid scholarship ID and email.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while processing the request.']);
    }
}

if (isset($_POST['deleteRejectedScholar'])) {
    try {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $student_name = isset($_POST['studentName']) ? $_POST['studentName'] : "";

        // echo json_encode(['student_name' => $student_name]);
        // exit();

        if ($id > 0) {

            $where = ['id' => $id];

            if ($db->delete('scholarships_scholars', $where)) {
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                $activity_log_data = [
                    'user_id' => $_SESSION['id'], // Assuming user ID is stored in session
                    'activity_name' => "Deleted rejected application of scholar $student_name", // Activity name
                    'date' => $createdAt // Current timestamp
                ];

                // Insert the activity log
                $db->insert('activity_log', $activity_log_data);

                $_SESSION['success'] = 'Scholar Application deleted successfully';
                echo json_encode(['success' => true, 'message' => 'Scholar Application deleted successfully.']);
            } else {
                $_SESSION['failed'] = 'Delete failed. Please try again';
                echo json_encode(['success' => false, 'message' => 'Scholar Application deletion failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID provided.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while deleting the program.']);
    }
}

// EMPLOYER FUNCTION

if (isset($_POST['getAllEmployer'])) {

    try {
        $employersData = $db->getAllEmployer();

        if ($employersData !== FALSE) {
            echo json_encode(['success' => TRUE, 'employersData' => $employersData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Employer Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['getAllJobs'])) {

    try {
        $jobsData = $db->getAllJobs();

        if ($jobsData !== FALSE) {
            echo json_encode(['success' => TRUE, 'jobsData' => $jobsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Jobs Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['getMyJobs'])) {

    $employer_id = isset($_POST['employer_id']) ? $_POST['employer_id'] : "";

    try {
        $myJobsData = $db->getMyJobs($employer_id);

        if ($myJobsData !== FALSE) {
            echo json_encode(['success' => TRUE, 'myJobsData' => $myJobsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Jobs Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['addJob'])) {
    try {
        // Collecting form data
        $employer_id = isset($_POST['userId']) ? $_POST['userId'] : "";
        $company = isset($_POST['company']) ? $_POST['company'] : "";
        $position = isset($_POST['position']) ? $_POST['position'] : "";
        $description = isset($_POST['description']) ? $_POST['description'] : "";
        $salary = isset($_POST['salary']) ? $_POST['salary'] : "";
        $requirements = isset($_POST['requirements']) ? $_POST['requirements'] : "";
        $application_start = isset($_POST['application_start']) ? $_POST['application_start'] : "";
        $application_deadline = isset($_POST['application_deadline']) ? $_POST['application_deadline'] : "";

        // Validate the inputs
        if (
            !empty($employer_id) && !empty($company) && !empty($position) && !empty($description) && !empty($salary) && !empty($requirements) &&
            !empty($application_start) && !empty($application_deadline)
        ) {

            // Ensure proper format for dates and numeric values
            if (DateTime::createFromFormat('Y-m-d', $application_start) && DateTime::createFromFormat('Y-m-d', $application_deadline)) {

                // Prepare data for insertion
                $data = [
                    'user_id' => $employer_id,
                    'company' => $company,
                    'position' => $position,
                    'description' => $description,
                    'salary' => $salary,
                    'requirements' => $requirements,
                    'application_start' => $application_start,
                    'application_deadline' => $application_deadline,
                    'status' => 1,
                ];

                // Attempt to insert data into the database
                if ($db->insert('employmment_jobs', $data)) {
                    // Set timezone
                    $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                    $date = new DateTime('now', $timezone); // Get the current time in that timezone
                    $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                    $activity_log_data = [
                        'user_id' => $_SESSION['id'], // Assuming user ID is stored in session
                        'activity_name' => "Added job $position by $company", // Activity name
                        'date' => $createdAt // Current timestamp
                    ];

                    // Insert the activity log
                    $db->insert('activity_log', $activity_log_data);

                    $_SESSION['success'] = 'Job opening added successfully';
                    echo json_encode(['success' => true, 'message' => 'Job opening added successfully.']);
                } else {
                    $_SESSION['failed'] = 'Creation failed. Please try again';
                    echo json_encode(['success' => false, 'message' => 'Job opening creation failed.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid data format. Please check dates and slot.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please provide all the required details.']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred.']);
    }
}

if (isset($_POST['editJobs'])) {

    try {
        // Collecting form data
        $jobId = isset($_POST['jobId']) ? $_POST['jobId'] : "";
        $company = isset($_POST['editCompany']) ? $_POST['editCompany'] : "";
        $position = isset($_POST['editPosition']) ? $_POST['editPosition'] : "";
        $salary = isset($_POST['editSalary']) ? $_POST['editSalary'] : "";
        $requirements = isset($_POST['editRequirements']) ? $_POST['editRequirements'] : "";
        $application_start = isset($_POST['editApplication_start']) ? $_POST['editApplication_start'] : "";
        $application_deadline = isset($_POST['editApplication_deadline']) ? $_POST['editApplication_deadline'] : "";
        $status = isset($_POST['editStatus']) ? $_POST['editStatus'] : "";

        // Validate the inputs
        if (
            !empty($company) && !empty($position) && !empty($salary) && !empty($requirements) &&
            !empty($application_start) && !empty($application_deadline) && isset($status)
        ) {

            // Ensure proper format for dates and numeric values
            if (DateTime::createFromFormat('Y-m-d', $application_start) && DateTime::createFromFormat('Y-m-d', $application_deadline) && ($status == 0 || $status == 1)) {

                // Prepare data for update
                $data = [
                    'company' => $company,
                    'position' => $position,
                    'salary' => $salary,
                    'requirements' => $requirements,
                    'application_start' => $application_start,
                    'application_deadline' => $application_deadline,
                    'status' => $status
                ];

                // WHERE clause to update the specific program
                $where = ['id' => $jobId];

                // Attempt to update data in the database
                if ($db->update('employmment_jobs', $data, $where)) {
                    // Set timezone
                    $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                    $date = new DateTime('now', $timezone); // Get the current time in that timezone
                    $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                    $activity_log_data = [
                        'user_id' => $_SESSION['id'], // Assuming user ID is stored in session
                        'activity_name' => "Edited job $position by $company", // Activity name
                        'date' => $createdAt // Current timestamp
                    ];

                    // Insert the activity log
                    $db->insert('activity_log', $activity_log_data);

                    $_SESSION['success'] = 'Job Opening updated successfully';
                    echo json_encode(['success' => true, 'message' => 'Job Opening updated successfully.']);
                } else {
                    $_SESSION['failed'] = 'Update failed. Please try again';
                    echo json_encode(['success' => false, 'message' => 'Job Opening update failed.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid data format. Please check dates and slot.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please provide all the required details.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while updating the program.']);
    }
}

if (isset($_POST['deleteJob'])) {
    try {
        $programId = isset($_POST['deleteJobId']) ? intval($_POST['deleteJobId']) : 0;
        $company = isset($_POST['jobCompany']) ? $_POST['jobCompany'] : "";
        $position = isset($_POST['jobPosition']) ? $_POST['jobPosition'] : "";

        // echo json_encode(['company' => $company, 'position' => $postion]);
        // exit();

        if ($programId > 0) {

            $where = ['id' => $programId];

            if ($db->delete('employmment_jobs', $where)) {
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                $activity_log_data = [
                    'user_id' => $_SESSION['id'], // Assuming user ID is stored in session
                    'activity_name' => "Deleted job $position by $company", // Activity name
                    'date' => $createdAt // Current timestamp
                ];

                // Insert the activity log
                $db->insert('activity_log', $activity_log_data);

                $_SESSION['success'] = 'Job Opening deleted successfully';
                echo json_encode(['success' => true, 'message' => 'Job Opening deleted successfully.']);
            } else {
                $_SESSION['failed'] = 'Delete failed. Please try again';
                echo json_encode(['success' => false, 'message' => 'Job Opening deletion failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID provided.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while deleting the program.']);
    }
}

if (isset($_POST['getPendingJobApplications'])) {

    $employer_id = isset($_POST['employer_id']) ? $_POST['employer_id'] : "";

    try {
        $pendingJobApplicationsData = $db->getPendingJobApplications($employer_id);

        if ($pendingJobApplicationsData !== FALSE) {
            echo json_encode(['success' => TRUE, 'pendingJobApplicationsData' => $pendingJobApplicationsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Jobs Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['scholarAction'])) {

    try {
        $action = $_POST['scholarAction'];

        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";

        // New data to send in the email
        $applicantName = isset($_POST['applicantName']) ? $_POST['applicantName'] : "";
        $company = isset($_POST['company']) ? $_POST['company'] : "";
        $position = isset($_POST['position']) ? $_POST['position'] : "";

        if (!empty($id) && !empty($email)) {
            // Define the data array to update the status
            $data = [];
            $message = '';

            if ($action === 'acceptJobApplication') {
                $data['status'] = 1; // Adjust as per your database representation
                $data['approved_on'] = date('Y-m-d'); // Format: YYYY-MM-DD
                $message = 'Job application accepted successfully.';
                $act = 'accepted';
                $emailSubject = 'Job Application Status';
                $emailBody = "Dear $applicantName,\n\nCongratulations! We are pleased to inform you that your application for the position of $position at $company has been accepted. Please wait for the next phase of your hiring process.\n\nBest regards,\n$company";
            } elseif ($action === 'rejectJobApplication') {
                $data['status'] = 0; // Adjust as per your database representation
                $data['approved_on'] = date('Y-m-d'); // Format: YYYY-MM-DD
                $message = 'Job application rejected successfully.';
                $act = 'rejected';
                $emailSubject = 'Job Application Status';
                $emailBody = "Dear $applicantName,\n\nThank you for applying for the position of $position at $company. Unfortunately, after careful consideration, we have decided not to move forward with your application at this time.\n\nBest regards,\n$company";
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid action specified.']);
                exit;
            }

            // Update the job application status in the database
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
                $mail->Body = nl2br($emailBody); // Convert newlines to <br> for HTML

                // Send the email
                if ($mail->send()) {

                    $user_id = $_SESSION['id']; // Assuming user ID is stored in session
                    // Set timezone
                    $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                    $date = new DateTime('now', $timezone); // Get the current time in that timezone
                    $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                    $activity_log_data = [
                        'user_id' => $user_id, // User performing the action
                        'activity_name' => "$applicantName application for $position was $act", // Activity name based on action
                        'date' => $createdAt // Current timestamp
                    ];

                    // Insert into activity log
                    $db->insert('activity_log', $activity_log_data); // Insert activity log

                    $_SESSION['success'] = $message;
                    echo json_encode(['success' => true, 'message' => $message]);
                } else {
                    $_SESSION['failed'] = 'Email could not be sent. Please try again';
                    echo json_encode(['success' => false, 'message' => 'Job application update succeeded, but email notification failed.']);
                }
            } else {
                $_SESSION['failed'] = 'Update failed. Please try again';
                echo json_encode(['success' => false, 'message' => 'Job application update failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please provide a valid job application ID and email.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while processing the request.']);
    }
}

if (isset($_POST['getApprovedJobApplications'])) {

    $employer_id = isset($_POST['employer_id']) ? $_POST['employer_id'] : "";

    try {
        $approvedJobApplicationsData = $db->getApprovedJobApplicatons($employer_id);

        if ($approvedJobApplicationsData !== FALSE) {
            echo json_encode(['success' => TRUE, 'approvedJobApplicationsData' => $approvedJobApplicationsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Jobs Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['editJobApplication'])) {
    try {
        $id = isset($_POST['jobApplicationId']) ? $_POST['jobApplicationId'] : "";
        $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : "";
        $message = isset($_POST['message']) ? $_POST['message'] : "";
        $date = isset($_POST['date']) ? $_POST['date'] : "";
        $applicantEmail = isset($_POST['applicantEmail']) ? $_POST['applicantEmail'] : "";
        $applicantName = isset($_POST['applicantName']) ? $_POST['applicantName'] : "";
        $company = isset($_POST['company']) ? $_POST['company'] : "";

        if (!empty($id) && !empty($remarks)) {
            // Save remarks to the database
            $data = [
                'remarks' => $remarks
            ];
            $where = ['id' => $id];

            if ($db->update('employment_job_applications', $data, $where)) {
                // Sending email notification to the applicant
                $emailSubject = 'Update on Your Job Application';
                $emailBody = "Dear $applicantName,\n\n$message\nwhich will be your $remarks\non $date\nBest regards,\n$company";

                // Set up SMTP email
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'lupaoportal@gmail.com';
                $mail->Password = 'tdjtjnjcbtxffwls';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Set the sender
                $mail->setFrom('lupaoportal@gmail.com', 'Lupao Employment and Scholarship Portal');

                // Recipients
                $mail->addAddress($applicantEmail); // Send to the applicant's email

                // Email content
                $mail->isHTML(true);
                $mail->Subject = $emailSubject;
                $mail->Body = nl2br($emailBody); // Convert newlines to <br> for HTML email formatting

                // Attempt to send the email
                if ($mail->send()) {

                    $user_id = $_SESSION['id']; // Assuming user ID is stored in session
                    // Set timezone
                    $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                    $date = new DateTime('now', $timezone); // Get the current time in that timezone
                    $createdAt = $date->format('Y-m-d'); // Format the date in 'Y-m-d H:i:s'
                    $timeAt = $date->format('H:i:s');

                    $activity_log_data = [
                        'user_id' => $user_id, // User performing the action
                        'activity_name' => "Sent a notification to $applicantName for $remarks on $date", // Activity name based on action
                        'date' => $createdAt, // Current timestamp
                        'time' => $timeAt,
                    ];

                    // Insert into activity log
                    $db->insert('activity_log', $activity_log_data); // Insert activity log

                    $_SESSION['success'] = 'Scholarship program updated successfully. Email sent to the applicant.';
                    echo json_encode(['success' => true, 'message' => 'Scholarship program updated successfully. Email sent to the applicant.']);
                } else {
                    $_SESSION['failed'] = 'Scholarship program updated, but email notification failed.';
                    echo json_encode(['success' => false, 'message' => 'Scholarship program updated, but email notification failed.']);
                }
            } else {
                $_SESSION['failed'] = 'Update failed. Please try again';
                echo json_encode(['success' => false, 'message' => 'Scholarship program update failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please provide all the required details.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while updating the program.']);
    }
}

if (isset($_POST['getRejectedJobApplications'])) {

    $employer_id = isset($_POST['employer_id']) ? $_POST['employer_id'] : "";

    try {
        $rejectedJobApplicationsData = $db->getRejectedJobApplications($employer_id);

        if ($rejectedJobApplicationsData !== FALSE) {
            echo json_encode(['success' => TRUE, 'rejectedJobApplicationsData' => $rejectedJobApplicationsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Jobs Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['deleteRejectedJobApplication'])) {
    try {
        $applicationId = $_POST['applicationId'];

        $table = 'employment_job_applications';
        $where = ['id' => $applicationId];

        // Call the delete method
        if ($db->delete($table, $where)) {

            $user_id = $_SESSION['id']; // Assuming user ID is stored in session
            // Set timezone
            $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
            $date = new DateTime('now', $timezone); // Get the current time in that timezone
            $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

            $activity_log_data = [
                'user_id' => $user_id, // User performing the action
                'activity_name' => "Deleted rejected job application", // Activity name based on action
                'date' => $createdAt // Current timestamp
            ];

            // Insert into activity log
            $db->insert('activity_log', $activity_log_data); // Insert activity log

            echo json_encode(['success' => true, 'message' => 'User has been deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while deleting the user.']);
    }
}

if (isset($_POST['getAllUsers'])) {

    try {
        $usersData = $db->getAllUsers();

        if ($usersData !== FALSE) {
            echo json_encode(['success' => TRUE, 'usersData' => $usersData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Users Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['getPendingRegistration'])) {

    try {
        $pendingRegistrationData = $db->getPendingUsers();

        if ($pendingRegistrationData !== FALSE) {
            echo json_encode(['success' => TRUE, 'pendingRegistrationData' => $pendingRegistrationData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No pending registration Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['registrationAction'])) {
    try {
        $registrationAction = $_POST['registrationAction'];
        $userId = $_POST['userId'];
        $userName = $_POST['userName'];
        $userEmail = $_POST['email'];
        $userContact = $_POST['contact'];

        $emailSubject = '';
        $emailBody = '';
        $message = '';
        $act = '';

        if ($registrationAction == 'acceptUser') {
            $result = $db->update('user_table', ['status' => 1], ['id' => $userId]);
            $act = 'Accept/Enabled registration';
            $message = 'User accepted successfully.';
            $emailSubject = 'User Registration Status';
            $emailBody = "Dear $userName, <br><br>Congratulations! Your registration has been approved and your account is now active.";
        } elseif ($registrationAction == 'rejectUser') {
            $result = $db->update('user_table', ['status' => 0], ['id' => $userId]);
            $act = 'Reject registration';
            $message = 'User rejected successfully.';
            $emailSubject = 'User Registration Status';
            $emailBody = "Dear $userName, <br><br>We regret to inform you that your registration has been rejected. Please contact support for further details.";
        } elseif ($registrationAction == 'disableUser') {
            $result = $db->update('user_table', ['status' => 3], ['id' => $userId]);
            $act = 'Disable';
            $message = 'User disabled successfully.';
            $emailSubject = 'Account Status';
            $emailBody = "Dear $userName, <br><br>Your account has been disabled. Please contact support for assistance.";
        }

        if ($result) {
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

            // Recipient
            $mail->addAddress($userEmail);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = $emailSubject;
            $mail->Body = $emailBody;

            if ($mail->send()) {
                // Log activity
                $user_id = $_SESSION['id']; // Assuming user ID is stored in session
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                $activity_log_data = [
                    'user_id' => $user_id,
                    'activity_name' => "$act $userName",
                    'date' => $createdAt
                ];

                $db->insert('activity_log', $activity_log_data);

                echo json_encode(['success' => true, 'message' => $message]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Action succeeded, but email notification failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to perform action.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while processing the request.']);
    }
}

if (isset($_POST['getApprovedRegistration'])) {

    try {
        $approvedRegistrationData = $db->getApprovedRegistrations();

        if ($approvedRegistrationData !== FALSE) {
            echo json_encode(['success' => TRUE, 'approvedRegistrationData' => $approvedRegistrationData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No pending registration Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['getRejectedApplication'])) {

    try {
        $rejectedApplicationData = $db->getRejectedRegistrations();

        if ($rejectedApplicationData !== FALSE) {
            echo json_encode(['success' => TRUE, 'rejectedApplicationData' => $rejectedApplicationData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No rejected registration Found']);
        }
    } catch (Exception $e) {
        // Log error and output JSON response
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['deleteRejectedApplication'])) {
    try {
        $userId = $_POST['userId'];
        $userName = $_POST['userName'];

        $table = 'user_table';
        $where = ['id' => $userId];

        // Call the delete method
        if ($db->delete($table, $where)) {

            $user_id = $_SESSION['id']; // Assuming user ID is stored in session
            // Set timezone
            $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
            $date = new DateTime('now', $timezone); // Get the current time in that timezone
            $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

            $activity_log_data = [
                'user_id' => $user_id, // User performing the action
                'activity_name' => "Deleted rejected registration of $userName", // Activity name based on action
                'date' => $createdAt // Current timestamp
            ];

            $db->insert('activity_log', $activity_log_data); // Insert activity log

            echo json_encode(['success' => true, 'message' => 'User has been deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while deleting the user.']);
    }
}

if (isset($_POST['getAllAnnouncements'])) {

    try {
        $announcementsData = $db->getAllAnnouncements();

        if ($announcementsData !== FALSE) {
            echo json_encode(['success' => TRUE, 'announcementsData' => $announcementsData]);
        } else {
            echo json_encode(['success' => FALSE, 'message' => 'No Users Found']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => FALSE, 'message' => 'An error occurred while fetching data.']);
    }
}

if (isset($_POST['addAnnouncement'])) {
    try {
        $title = isset($_POST['title']) ? $_POST['title'] : "";
        $description = isset($_POST['description']) ? $_POST['description'] : "";

        if (!empty($title) && !empty($description)) {

            $data = [
                'title' => $title,
                'description' => $description,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 1,
            ];

            if ($db->insert('announcements', $data)) {

                $user_id = $_SESSION['id']; // Assuming user ID is stored in session
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                $activity_log_data = [
                    'user_id' => $user_id, // User performing the action
                    'activity_name' => "Added announcement $title", // Activity name based on action
                    'date' => $createdAt // Current timestamp
                ];

                $db->insert('activity_log', $activity_log_data); // Insert activity log

                $_SESSION['success'] = 'Announcement added successfully';
                echo json_encode(['success' => true, 'message' => 'Announcement added successfully.']);
            } else {
                $_SESSION['failed'] = 'Creation failed. Please try again';
                echo json_encode(['success' => false, 'message' => 'Announcement creation failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please provide all the required details.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred.']);
    }
}

if (isset($_POST['deleteAnnouncement'])) {
    try {
        $announcementId = $_POST['announcementId'];

        $table = 'announcements';
        $where = ['id' => $announcementId];

        // Call the delete method
        if ($db->delete($table, $where)) {

            $user_id = $_SESSION['id']; // Assuming user ID is stored in session
            // Set timezone
            $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
            $date = new DateTime('now', $timezone); // Get the current time in that timezone
            $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

            $activity_log_data = [
                'user_id' => $user_id, // User performing the action
                'activity_name' => "Deleted announcement", // Activity name based on action
                'date' => $createdAt // Current timestamp
            ];

            $db->insert('activity_log', $activity_log_data); // Insert activity log

            echo json_encode(['success' => true, 'message' => 'Announcement has been deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete announcement.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while deleting the announcement.']);
    }
}

if (isset($_POST['updateAnnouncement'])) {

    try {
        $id = isset($_POST['announcementId']) ? $_POST['announcementId'] : "";
        $title = isset($_POST['editAnnouncementTitle']) ? $_POST['editAnnouncementTitle'] : "";
        $description = isset($_POST['editAnnouncementDescription']) ? $_POST['editAnnouncementDescription'] : "";

        if (!empty($id) && !empty($title) && !empty($description)) {

            $data = [
                'title' => $title,
                'description' => $description,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $where = ['id' => $id];

            if ($db->update('announcements', $data, $where)) {

                $user_id = $_SESSION['id']; // Assuming user ID is stored in session
                // Set timezone
                $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
                $date = new DateTime('now', $timezone); // Get the current time in that timezone
                $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

                $activity_log_data = [
                    'user_id' => $user_id, // User performing the action
                    'activity_name' => "Updated announcement $title", // Activity name based on action
                    'date' => $createdAt // Current timestamp
                ];

                $db->insert('activity_log', $activity_log_data); // Insert activity log

                $_SESSION['success'] = 'Announcements updated successfully';
                echo json_encode(['success' => true, 'message' => 'Announcements updated successfully.']);
            } else {
                $_SESSION['failed'] = 'Update failed. Please try again';
                echo json_encode(['success' => false, 'message' => 'Announcements update failed.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please provide all the required details.']);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred while updating the program.']);
    }
}

if (isset($_POST['announcementAction'])) {
    $announcementAction = $_POST['announcementAction'];
    $announcementId = $_POST['announcementId'];

    if ($announcementAction == 'archiveAnnouncement') {
        $result = $db->update('announcements', ['status' => 0], ['id' => $announcementId]);
        $act = 'Archived';

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Archived successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to archive announcement.']);
        }
    } elseif ($announcementAction == 'retrieveAnnouncement') {
        $result = $db->update('announcements', ['status' => 1], ['id' => $announcementId]);
        $act = 'Retreived';

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Announcement rejected successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to reject Announcement.']);
        }
    }

    $user_id = $_SESSION['id']; // Assuming user ID is stored in session
    // Set timezone
    $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
    $date = new DateTime('now', $timezone); // Get the current time in that timezone
    $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'

    $activity_log_data = [
        'user_id' => $user_id, // User performing the action
        'activity_name' => "$act announcement $announcementId", // Activity name based on action
        'date' => $createdAt // Current timestamp
    ];

    $db->insert('activity_log', $activity_log_data); // Insert activity log
}
