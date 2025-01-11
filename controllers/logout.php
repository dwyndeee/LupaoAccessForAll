<?php

session_start();

if (isset($_SESSION['id'])) {

    require_once '../db/dbconfig.php';

    $db = new DB();
    // Set timezone
    $timezone = new DateTimeZone('Asia/Manila'); // Set your desired timezone
    $date = new DateTime('now', $timezone); // Get the current time in that timezone
    $createdAt = $date->format('Y-m-d H:i:s'); // Format the date in 'Y-m-d H:i:s'
    $timeAt = $date->format('H:i:s');
    $activity_data = [
        'user_id' => $_SESSION['id'],
        'activity_name' => 'Logged out',
        'date' => $createdAt,
        'time' => $timeAt,
    ];
    error_log(print_r($activity_data, true));

    $db->insert('activity_log', $activity_data);
}

unset($_SESSION['logged_in']);
session_destroy();
session_abort();

header('Location: ../');
exit();
