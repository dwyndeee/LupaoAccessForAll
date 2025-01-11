<?php
header('Content-Type: application/json');

$host = "localhost"; // Change as needed
$user = "root"; // Change as needed
$password = ""; // Change as needed
$database = "lupao_portal"; // Change to your actual database name

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

$sql_scholarships = "SELECT id, grantor FROM scholarship_programs"; // Assuming you have a scholarships table
$sql_contacts = "SELECT contact_no, firstname, lastname FROM user_table"; // Fetch contact numbers and full names

$scholarships_result = $conn->query($sql_scholarships);
$contacts_result = $conn->query($sql_contacts);

$scholarships = [];
$contacts = [];

if ($scholarships_result->num_rows > 0) {
    while ($row = $scholarships_result->fetch_assoc()) {
        $scholarships[] = $row;
    }
}

if ($contacts_result->num_rows > 0) {
    while ($row = $contacts_result->fetch_assoc()) {
        $contacts[] = [
            'contact_no' => $row['contact_no'],
            'fullname' => $row['firstname'] . ' ' . $row['lastname']
        ];
    }
}

echo json_encode([
    'scholarships' => $scholarships,
    'contacts' => $contacts
]);

$conn->close();
