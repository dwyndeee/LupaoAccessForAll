<?php

session_start();

require "../db/dbconfig.php";

require "../vendor/autoload.php"; // Include Composer's autoload for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$db = new DB();


if (isset($_POST['programCount'])) {

    $ownerId = $_POST['ownerId'] ?? NULL;

    $count = $db->getProgramCount($ownerId);
    echo json_encode(['programsCount' => $count]);
    exit;
}

if (isset($_POST['jobsCount'])) {

    $ownerId = $_POST['ownerId'] ?? NULL;
    
    $count = $db->getJobsCount($ownerId);
    echo json_encode(['jobsCount' => $count]);
    exit;
}

if (isset($_POST['employersCount'])) {

    $ownerId = $_POST['ownerId'] ?? NULL;
    
    $count = $db->getEmployerCount($ownerId);
    echo json_encode(['employersCount' => $count]);
    exit;
}

if (isset($_POST['applicantCount'])) {

    $ownerId = $_POST['ownerId'] ?? NULL;
    
    $count = $db->getApplicantCount($ownerId);
    echo json_encode(['applicantCount' => $count]);
    exit;
}

if (isset($_POST['pendingJobApplicationsCount'])) {

    $ownerId = $_POST['ownerId'] ?? NULL;
    
    $count = $db->getPendingJobApplicationsCount($ownerId);
    echo json_encode(['pendingJobApplicationsCount' => $count]);
    exit;
}

if (isset($_POST['pendingSchoCount'])) {

    $ownerId = $_POST['ownerId'] ?? NULL;
    
    $count = $db->pendingSchoCount($ownerId);
    echo json_encode(['pendingSchoCount' => $count]);
    exit;
}

if (isset($_GET['getChartData'])) {
    $programCount = $db->getProgramCount();
    $jobsCount = $db->getJobsCount();

    $pieChartData = [
        ['label' => 'Scholarship Programs', 'value' => $programCount],
        ['label' => 'Job Openings', 'value' => $jobsCount],
    ];

    echo json_encode(['pieChartData' => $pieChartData]);
    exit;
}

if (isset($_GET['monthlyRegistrations'])) {
    $data = $db->getMonthlyRegistrations();
    echo json_encode(['monthlyData' => $data]);
    exit;
}
