<?php

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;


class DB
{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = '';
    private $db_name = 'lupao_portal';

    public $mysql;
    public $res;

    public function __construct()
    {
        try {
            if (!$this->mysql = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name)) {
                throw new Exception($this->mysql->connect_error);
            }

            // echo "Success: Connected to Database!";

        } catch (Exception $e) {
            die("Error on Database fix it quick!" . $e);
        }
    }

    //general Functions

    public function fetchSelect($result)
    {
        $records = array();

        while ($row = $result->fetch_assoc()) {
            array_push($records, $row);
        }
        $this->res = $records;
    }

    public function select($query, $params = [])
    {
        $stmt = $this->mysql->prepare($query);

        // Bind parameters if any
        if ($params) {
            $types = str_repeat('s', count($params)); // Assuming all parameters are strings; adjust as necessary
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result(); // Get the result set from the prepared statement

        return $result; // Return the result set
    }


    public function insert($table, $data)
    {
        $table_columns = implode(',', array_keys($data));
        $table_values = implode("','", $data);
        $sql = "INSERT INTO $table($table_columns) VALUES ('$table_values')";
        $result = $this->mysql->query($sql);

        if ($result) {
            return true; // Record added successfully
        } else {
            // Query execution error, handle it as needed
            return false;
        }
    }

    public function update($table, $data, $where)
    {

        $set = '';
        foreach ($data as $column => $value) {
            $set .= "$column = '$value', ";
        }
        $set = rtrim($set, ', ');

        $whereClause = '';
        foreach ($where as $column => $value) {
            $whereClause .= "$column = '$value' AND ";
        }
        $whereClause = rtrim($whereClause, ' AND ');

        $sql = "UPDATE $table SET $set WHERE $whereClause";

        $result = $this->mysql->query($sql);

        if ($result) {
            return true;
        } else {

            return false;
        }
    }

    public function delete($table, $where)
    {

        $table = $this->mysql->real_escape_string($table);

        $whereClause = [];
        foreach ($where as $key => $value) {
            $key = $this->mysql->real_escape_string($key);
            $value = $this->mysql->real_escape_string($value);
            $whereClause[] = "$key = '$value'";
        }
        $whereString = implode(' AND ', $whereClause);

        $sql = "DELETE FROM $table WHERE $whereString";

        $result = $this->mysql->query($sql);

        return $result ? true : false;
    }

    public function clearLogs($table, $where)
    {

        $table = $this->mysql->real_escape_string($table);

        $whereClause = [];
        foreach ($where as $key => $value) {
            $key = $this->mysql->real_escape_string($key);
            $value = $this->mysql->real_escape_string($value);
            $whereClause[] = "$key = '$value'";
        }
        $whereString = implode(' AND ', $whereClause);

        $sql = "DELETE FROM $table WHERE $whereString";

        $result = $this->mysql->query($sql);

        return $result ? true : false;
    }

    public function selectAllRoles($id = NULL)
    {
        $id = $this->mysql->real_escape_string($id);

        if ($id != null) {
            $sql = "SELECT * FROM user_table WHERE id = '$id'";
        } else {
            $sql = "SELECT * FROM user_table ";
        }

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $roles = [];
            while ($row = $result->fetch_assoc()) {
                $roles[] = $row;
            }

            return $roles;
        } else {
            return [];
        }
    }

    public function user_signup($user_type, $firstname, $lastname, $email, $password, $barangay, $contact_no, $birthdate, $gender, $file_paths = [])
    {
        $email = $this->mysql->real_escape_string($email);

        $check_email = "SELECT * FROM user_table WHERE email = '$email'";
        $check_result = $this->mysql->query($check_email);

        if ($check_result && $check_result->num_rows > 0) {
            return false;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'user_type' => $user_type,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $hashed_password,
            'baranggay' => $barangay,
            'contact_no' => $contact_no,
            'birthday' => $birthdate,
            'gender' => $gender,
        ];

        // Include file paths in the data array if they exist
        if (!empty($file_paths)) {
            foreach ($file_paths as $key => $path) {
                $data[$key . '_path'] = $path; // Assuming you want to save each file path with a suffix
            }
        }

        $result = $this->insert('user_table', $data);

        return $result;
    }

    public function login_user($email, $password)
    {
        $email = $this->mysql->real_escape_string($email);

        $sql = "SELECT u.*, utype.role AS user_role FROM user_table u INNER JOIN user_type utype ON u.user_type = utype.id WHERE u.email = '$email'";
        $result = $this->mysql->query($sql);

        if ($result) {
            if ($result->num_rows == 1) {
                $userData = $result->fetch_assoc();
                $hashed_password = $userData['password'];

                // Verify password
                if (password_verify($password, $hashed_password)) {
                    if ($userData['status'] == 1) { // Check if the account is activated

                        $_SESSION['logged_in'] = true;

                        return array(
                            'id' => $userData['id'],
                            'role' => $userData['user_role'],
                            'firstname' => $userData['firstname'],
                            'lastname' => $userData['lastname'],
                            'email' => $userData['email']
                        );
                    } else {
                        return 'not_activated'; // Account not activated
                    }
                } else {
                    return false; // Invalid credentials
                }
            } else {
                return 'not_found'; // User not found
            }
        } else {
            return false; // Query failed
        }
    }

    public function getUserByEmail($email)
    {

        $email = $this->mysql->real_escape_string($email);

        $sql = "SELECT * FROM user_table WHERE email = '$email'";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $user = [];
            while ($row = $result->fetch_assoc()) {
                $user[] = $row;
            }

            return $user;
        } else {
            return [];
        }
    }

    public function storePasswordResetToken($email, $token, $expires)
    {

        $email = $this->mysql->real_escape_string($email);
        $data = [
            'email' => $email,
            'token' => $token,
            'expires' => $expires,
        ];

        $result = $this->insert('password_reset_tokens', $data);

        return $result;
    }

    public function getTokenData($token)
    {
        $token = $this->mysql->real_escape_string($token);
        $sql = "SELECT * FROM password_reset_tokens WHERE token = '$token'";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            // Fetch the first row
            return $result->fetch_assoc();
        } else {
            return null; // Return null if no rows found
        }
    }

    public function updatePassword($email, $hashed_password)
    {
        $stmt = $this->mysql->prepare("UPDATE user_table SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        $result = $stmt->execute();

        return $result;
    }

    public function invalidateToken($token)
    {
        $token = $this->mysql->real_escape_string($token);
        $stmt = $this->mysql->prepare("DELETE FROM password_reset_tokens WHERE token = ?");
        $stmt->bind_param("s", $token);
        $result = $stmt->execute();

        return $result;
    }

    //end of general functions

    //Scholarship Programs Functions

    public function getAllScholarshipPrograms($ownerId = NULL)
    {

        $ownerId = $this->mysql->real_escape_string($ownerId);

        if ($ownerId != NULL) {
            $sql = "SELECT * FROM scholarship_programs WHERE id = '$ownerId'";
        } else {
            $sql = "SELECT * FROM scholarship_programs";
        }
        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $scholarship_programs = [];
            while ($row = $result->fetch_assoc()) {
                $scholarship_programs[] = $row;
            }
            return $scholarship_programs;
        } else {
            return [];
        }
    }
    public function getUserAppliedScholarships($userId)
    {
        $userId = $this->mysql->real_escape_string($userId);

        $sql = "SELECT program_id FROM scholarships_scholars WHERE student_id = '$userId'";
        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $appliedScholarships = [];
            while ($row = $result->fetch_assoc()) {
                $appliedScholarships[] = $row;
            }
            return $appliedScholarships;
        } else {
            return [];
        }
    }

    // NEWWWWWWWWWWWWWWWWWWWWWWWWWW
    public function isUserAppliedForScholarship($userId, $scholarshipId)
    {
        $userId = $this->mysql->real_escape_string($userId);
        $scholarshipId = $this->mysql->real_escape_string($scholarshipId);

        // Query to check if the user has applied for the given scholarship
        $sql = "SELECT 1 FROM scholarships_scholars WHERE student_id = '$userId' AND program_id = '$scholarshipId' LIMIT 1";
        $result = $this->mysql->query($sql);

        // If there is a result, the user has applied for this scholarship
        return $result->num_rows > 0;
    }

    // public function isUserAppliedForJob($userId, $jobId)
    // {
    //     $userId = $this->mysql->real_escape_string($userId);
    //     $jobId = $this->mysql->real_escape_string($jobId);

    //     // Query to check if the user has applied for the given job
    //     $sql = "SELECT 1 FROM job_applications WHERE user_id = '$userId' AND job_id = '$jobId' LIMIT 1";
    //     $result = $this->mysql->query($sql);

    //     // If there is a result, the user has applied for this job
    //     return $result->num_rows > 0;
    // }



    public function getAllScholar()
    {

        $sql = "SELECT ss.*, sp.grantor, sp.program_title, CONCAT(user.firstname, ' ', user.lastname) as student_name,
        user.email
        FROM scholarships_scholars ss
        INNER JOIN scholarship_programs sp ON ss.program_id = sp.id
        INNER JOIN user_table user ON ss.student_id = user.id
        WHERE ss.status = 1 ";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $scholars = [];
            while ($row = $result->fetch_assoc()) {
                $scholars[] = $row;
            }
            return $scholars;
        } else {
            return [];
        }
    }

    public function getAllScholarPending()
    {

        $sql = "SELECT ss.*, sp.grantor, sp.program_title, CONCAT(user.firstname, ' ', user.lastname) as student_name,
        user.email, user.contact_no
        FROM scholarships_scholars ss
        INNER JOIN scholarship_programs sp ON ss.program_id = sp.id
        INNER JOIN user_table user ON ss.student_id = user.id
        WHERE ss.status IS NULL ";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $pendingScholars = [];
            while ($row = $result->fetch_assoc()) {
                $pendingScholars[] = $row;
            }
            return $pendingScholars;
        } else {
            return [];
        }
    }

    public function getAllScholarRejected()
    {

        $sql = "SELECT ss.*, sp.grantor, sp.program_title, CONCAT(user.firstname, ' ', user.lastname) as student_name,
        user.email
        FROM scholarships_scholars ss
        INNER JOIN scholarship_programs sp ON ss.program_id = sp.id
        INNER JOIN user_table user ON ss.student_id = user.id
        WHERE ss.status = 0 ";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $rejectedScholars = [];
            while ($row = $result->fetch_assoc()) {
                $rejectedScholars[] = $row;
            }
            return $rejectedScholars;
        } else {
            return [];
        }
    }


    public function getAllScholarEmailOnProgram($program_id)
    {

        $program_id = $this->mysql->real_escape_string($program_id);

        $sql = "SELECT ss.*, sp.grantor, sp.program_title, CONCAT(user.firstname, ' ', user.lastname) as student_name,
        user.email
        FROM scholarships_scholars ss
        INNER JOIN scholarship_programs sp ON ss.program_id = sp.id
        INNER JOIN user_table user ON ss.student_id = user.id
        WHERE ss.status = 1 AND sp.id = '$program_id'";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $scholars = [];
            while ($row = $result->fetch_assoc()) {
                $scholars[] = $row;
            }
            return $scholars;
        } else {
            return [];
        }
    }
    // End of Scholarship Programs Functions


    // Employment Functions

    public function getAllEmployer()
    {

        $sql = "SELECT user.id AS user_id, user.*, utype.* FROM user_table user
        INNER JOIN user_type utype ON user.user_type = utype.id
        WHERE user.user_type = 2 AND user.status = 1";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $employer = [];
            while ($row = $result->fetch_assoc()) {
                $employer[] = $row;
            }
            return $employer;
        } else {
            return [];
        }
    }

    public function getAllJobs()
    {

        $sql = "SELECT job.*, CONCAT(user.firstname, ' ', user.lastname)
        AS employer_name
        FROM employmment_jobs job
        INNER JOIN user_table user ON job.user_id = user.id";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $jobs = [];
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
            return $jobs;
        } else {
            return [];
        }
    }

    public function getMyJobs($employer_id)
    {

        $employer_id = $this->mysql->real_escape_string($employer_id);

        $sql = "SELECT job.*, CONCAT(user.firstname, ' ', user.lastname)
        AS employer_name
        FROM employmment_jobs job
        INNER JOIN user_table user ON job.user_id = user.id
        WHERE user.id = '$employer_id'";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $myJobs = [];
            while ($row = $result->fetch_assoc()) {
                $myJobs[] = $row;
            }
            return $myJobs;
        } else {
            return [];
        }
    }


    public function getPendingJobApplications($employer_id)
    {

        $employer_id = $this->mysql->real_escape_string($employer_id);

        $sql = "SELECT ja.*, job.user_id AS employer_id, job.company, job.position, job.salary, job.requirements, job.application_deadline,
                CONCAT(user.firstname, ' ', user.lastname) AS applicant, user.email
                FROM employment_job_applications ja
                INNER JOIN employmment_jobs job ON ja.job_id = job.id
                INNER JOIN user_table user ON ja.applicant_id = user.id WHERE job.user_id = '$employer_id' AND ja.status IS NULL";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $pendingJobApplication = [];
            while ($row = $result->fetch_assoc()) {
                $pendingJobApplication[] = $row;
            }
            return $pendingJobApplication;
        } else {
            return [];
        }
    }

    public function getApprovedJobApplicatons($employer_id)
    {

        $employer_id = $this->mysql->real_escape_string($employer_id);

        $sql = "SELECT ja.*, job.user_id AS employer_id, job.company, job.position, job.salary, job.requirements, job.application_deadline,
                CONCAT(user.firstname, ' ', user.lastname) AS applicant, user.email
                FROM employment_job_applications ja
                INNER JOIN employmment_jobs job ON ja.job_id = job.id
                INNER JOIN user_table user ON ja.applicant_id = user.id WHERE job.user_id = '$employer_id' AND ja.status = 1";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $approvedJobApplications = [];
            while ($row = $result->fetch_assoc()) {
                $approvedJobApplications[] = $row;
            }
            return $approvedJobApplications;
        } else {
            return [];
        }
    }

    public function getRejectedJobApplications($employer_id)
    {

        $employer_id = $this->mysql->real_escape_string($employer_id);

        $sql = "SELECT ja.*, job.user_id AS employer_id, job.company, job.position, job.salary, job.requirements, job.application_deadline,
            CONCAT(user.firstname, ' ', user.lastname) AS applicant, user.email
            FROM employment_job_applications ja
            INNER JOIN employmment_jobs job ON ja.job_id = job.id
            INNER JOIN user_table user ON ja.applicant_id = user.id WHERE job.user_id = '$employer_id' AND ja.status = 0";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $rejectedJobApplications = [];
            while ($row = $result->fetch_assoc()) {
                $rejectedJobApplications[] = $row;
            }
            return $rejectedJobApplications;
        } else {
            return [];
        }
    }

    // End of Employment Function


    // User Management Functions
    public function getAllUsers()
    {
        $sql = "SELECT u.*, utype.role as user_role FROM user_table u INNER JOIN user_type utype ON u.user_type = utype.id";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } else {
            return [];
        }
    }

    public function getPendingUsers()
    {
        $sql = "SELECT u.*, utype.role as user_role FROM user_table u INNER JOIN user_type utype ON u.user_type = utype.id WHERE status IS NULL";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $pendingReg = [];
            while ($row = $result->fetch_assoc()) {
                $pendingReg[] = $row;
            }
            return $pendingReg;
        } else {
            return [];
        }
    }

    public function getApprovedRegistrations()
    {
        $sql = "SELECT u.*, utype.role as user_role FROM user_table u INNER JOIN user_type utype ON u.user_type = utype.id WHERE status = 1 OR status = 3";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $approvedReg = [];
            while ($row = $result->fetch_assoc()) {
                $approvedReg[] = $row;
            }
            return $approvedReg;
        } else {
            return [];
        }
    }

    public function getRejectedRegistrations()
    {
        $sql = "SELECT u.*, utype.role as user_role FROM user_table u INNER JOIN user_type utype ON u.user_type = utype.id WHERE status = 0";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $rejectedReg = [];
            while ($row = $result->fetch_assoc()) {
                $rejectedReg[] = $row;
            }
            return $rejectedReg;
        } else {
            return [];
        }
    }
    // End of User Management Functions

    // Announcements Functions

    public function getAllAnnouncements()
    {
        $sql = "SELECT * FROM announcements";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $announcements = [];
            while ($row = $result->fetch_assoc()) {
                $announcements[] = $row;
            }
            return $announcements;
        } else {
            return [];
        }
    }

    // End of Announcements Functions

    // Analytics Controller
    public function getProgramCount($ownerId = NULL)
    {

        $ownerId = $this->mysql->real_escape_string($ownerId);

        if ($ownerId != NULL) {
            $sql = "SELECT COUNT(*) as count FROM scholarship_programs WHERE id = '$ownerId'";
        } else {
            $sql = "SELECT COUNT(*) as count FROM scholarship_programs";
        }

        $result = $this->mysql->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'];
        } else {
            return 0; // or handle error as needed
        }
    }

    public function getJobsCount($ownerId = NULL)
    {

        $ownerId = $this->mysql->real_escape_string($ownerId);

        if ($ownerId != NULL) {
            $sql = "SELECT COUNT(*) as count FROM employmment_jobs WHERE user_id = '$ownerId'";
        } else {
            $sql = "SELECT COUNT(*) as count FROM employmment_jobs";
        }

        $result = $this->mysql->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'];
        } else {
            return 0; // or handle error as needed
        }
    }

    public function getEmployerCount($ownerId = NULL)
    {

        $ownerId = $this->mysql->real_escape_string($ownerId);

        if ($ownerId != NULL) {
            $sql = "SELECT COUNT(*) as count FROM user_table WHERE user_type = '2' AND id = '$ownerId'";
        } else {
            $sql = "SELECT COUNT(*) as count FROM user_table WHERE user_type = '2'";
        }

        $result = $this->mysql->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'];
        } else {
            return 0; // or handle error as needed
        }
    }

    public function getApplicantCount($ownerId = NULL)
    {

        $ownerId = $this->mysql->real_escape_string($ownerId);

        if ($ownerId != NULL) {
            $sql = "SELECT COUNT(*) as count FROM user_table WHERE user_type = '3' AND id = '$ownerId'";
        } else {
            $sql = "SELECT COUNT(*) as count FROM user_table WHERE user_type = '3'";
        }

        $result = $this->mysql->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'];
        } else {
            return 0; // or handle error as needed
        }
    }

    public function getPendingJobApplicationsCount($ownerId = NULL)
    {

        $ownerId = $this->mysql->real_escape_string($ownerId);

        if ($ownerId != NULL) {
            // Count pending applications for the specific employer
            $sql = "SELECT COUNT(*) as count 
                    FROM employment_job_applications ja
                    INNER JOIN employmment_jobs job ON ja.job_id = job.id 
                    WHERE ja.status IS NULL AND job.user_id = '$ownerId'";
        } else {
            // Count all pending applications
            $sql = "SELECT COUNT(*) as count FROM employment_job_applications WHERE status IS NULL";
        }

        $result = $this->mysql->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'];
        } else {
            return 0; // or handle error as needed
        }
    }

    public function pendingSchoCount($ownerId = NULL)
    {

        $ownerId = $this->mysql->real_escape_string($ownerId);

        if ($ownerId != NULL) {
            $sql = "SELECT COUNT(*) as count FROM scholarships_scholars WHERE status IS NULL AND id = '$ownerId'";
        } else {
            $sql = "SELECT COUNT(*) as count FROM scholarships_scholars WHERE status IS NULL";
        }

        $result = $this->mysql->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'];
        } else {
            return 0; // or handle error as needed
        }
    }

    public function getMonthlyRegistrations()
    {
        $sql = "SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(id) AS count 
                FROM user_table 
                WHERE created_at IS NOT NULL 
                GROUP BY month 
                ORDER BY month";

        $result = $this->mysql->query($sql);
        $monthlyData = [];

        while ($row = $result->fetch_assoc()) {
            $monthlyData[] = ['month' => $row['month'], 'count' => $row['count']];
        }

        return $monthlyData;
    }

    // Profile Functions
    public function getUserDetails($userId = NULL)
    {

        $userId = $this->mysql->real_escape_string($userId);

        if ($userId != NULL) {
            $sql = "SELECT * FROM user_table WHERE id = '$userId'";
        } else {
            return null; // Or handle the case where no userId is provided
        }

        $result = $this->mysql->query($sql);

        if ($result) {
            return $result->fetch_assoc(); // Fetch the user details
        } else {
            return null; // Or handle error as needed
        }
    }

    public function getUserPendingJobApplications($applicant_id)
    {

        $applicant_id = $this->mysql->real_escape_string($applicant_id);

        $sql = "SELECT ja.*, job.user_id AS employer_id, job.company, job.position, job.salary, job.requirements, job.application_deadline,
                CONCAT(user.firstname, ' ', user.lastname) AS applicant, user.email
                FROM employment_job_applications ja
                INNER JOIN employmment_jobs job ON ja.job_id = job.id
                INNER JOIN user_table user ON ja.applicant_id = user.id WHERE ja.applicant_id = '$applicant_id'";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $pendingJobApplication = [];
            while ($row = $result->fetch_assoc()) {
                $pendingJobApplication[] = $row;
            }
            return $pendingJobApplication;
        } else {
            return [];
        }
    }

    public function getUserScholarPending($student_id)
    {

        $student_id = $this->mysql->real_escape_string($student_id);

        $sql = "SELECT ss.*, sp.grantor, sp.program_title, CONCAT(user.firstname, ' ', user.lastname) as student_name,
        user.email
        FROM scholarships_scholars ss
        INNER JOIN scholarship_programs sp ON ss.program_id = sp.id
        INNER JOIN user_table user ON ss.student_id = user.id
        WHERE ss.student_id = '$student_id' ";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $pendingScholars = [];
            while ($row = $result->fetch_assoc()) {
                $pendingScholars[] = $row;
            }
            return $pendingScholars;
        } else {
            return [];
        }
    }


    public function getAllUserLog($user_id = NULL)
    {

        $user_id = $this->mysql->real_escape_string($user_id);

        if ($user_id != NULL) {
            $sql = "SELECT * FROM activity_log WHERE user_id = '$user_id'";
        } else {
            return null;
        }

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $logs = [];
            while ($row = $result->fetch_assoc()) {
                $logs[] = $row;
            }
            return $logs;
        } else {
            return [];
        }
    }

    public function getUnreadMessagesCount($user_id)
    {
        $user_id = $this->mysql->real_escape_string($user_id);

        $sql = "SELECT COUNT(*) as unread_count FROM messages_table WHERE receiver_id = '$user_id' AND status IS NULL";

        $result = $this->mysql->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['unread_count'];  // Return the unread message count
        }

        return 0;  // Return 0 if there was an error or no unread messages
    }

    public function getAllMessages($sender_id = NULL)
    {

        $sender_id = $this->mysql->real_escape_string($sender_id);

        $sql = "SELECT m.*, 
        CONCAT(sender.firstname, ' ', sender.lastname) AS sender_user_name, 
        CONCAT(receiver.firstname, ' ', receiver.lastname) AS receiver_user_name
        FROM messages_table m
        INNER JOIN user_table sender ON sender.id = m.sender_id
        INNER JOIN user_table receiver ON receiver.id = m.receiver_id
        WHERE m.receiver_id = '$sender_id' AND m.status IS NULL";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $messages = [];  // Initialize an array to store the messages

            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
            return $messages;  // Return the messages
        } else {
            return [];  // No messages found
        }
    }

    // public function getConversationByMessageId($messageId) {

    //     $messageId = $this->mysql->real_escape_string($messageId);

    //     $sql = "SELECT m.message, m.created_at, u.firstname AS sender_user_name
    //             FROM messages_table m
    //             INNER JOIN user_table u ON m.sender_id = u.id
    //             WHERE m.id = '$messageId'
    //             ORDER BY m.created_at ASC";

    //     $result = $this->mysql->query($sql);

    //     if ($result->num_rows > 0) {
    //         $conversation = [];  // Initialize an array to store the conversation

    //         while ($row = $result->fetch_assoc()) {
    //             $conversation[] = $row;
    //         }
    //         return $conversation;  // Return the conversation
    //     } else {
    //         return [];  // No conversation found
    //     }
    // }

    public function getConversationByMessageId($messageId, $senderId)
    {
        $messageId = $this->mysql->real_escape_string($messageId);
        $senderId = $this->mysql->real_escape_string($senderId);

        // First, retrieve the message and sender to identify the other user
        $sql = "SELECT m.sender_id, m.receiver_id
                FROM messages_table m
                WHERE m.id = '$messageId'";

        $result = $this->mysql->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $otherUserId = ($row['sender_id'] == $senderId) ? $row['receiver_id'] : $row['sender_id']; // Identify the other user

            // Retrieve the entire conversation between sender and receiver
            $sql = "SELECT m.message, m.created_at, m.sender_id, u.firstname AS sender_user_name
                    FROM messages_table m
                    INNER JOIN user_table u ON m.sender_id = u.id
                    WHERE (m.sender_id = '$senderId' AND m.receiver_id = '$otherUserId')
                       OR (m.sender_id = '$otherUserId' AND m.receiver_id = '$senderId')
                    ORDER BY m.created_at ASC";

            $result = $this->mysql->query($sql);

            if ($result->num_rows > 0) {
                $conversation = [];
                while ($row = $result->fetch_assoc()) {
                    $conversation[] = $row;
                }
                return $conversation;
            } else {
                return []; // No conversation found
            }
        } else {
            return []; // Message ID not found
        }
    }


    public function markMessageAsRead($message_id)
    {
        $message_id = $this->mysql->real_escape_string($message_id);

        $sql = "UPDATE messages_table 
                SET status = 1 
                WHERE id = '$message_id' AND status IS NULL";

        return $this->mysql->query($sql); // Returns true if the update was successful
    }
}
