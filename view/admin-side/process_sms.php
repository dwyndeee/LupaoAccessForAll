<?php 
header("Content-Type: application/json");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Read the raw POST data
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Check if required data is provided
if (!isset($data["message"], $data["contacts"]) || !is_array($data["contacts"])) {
    echo json_encode(["success" => false, "message" => "Invalid request. Contacts should be an array."]);
    exit;
}

// Pushbullet Access Token
$accessToken = "o.oyxGDU8JNbpcjk5kBZFiFhVMWQLHsNRG";

// Target Device Identifier
$targetDeviceIden = "ujEN8m7eYg0sjyzNlRvXEq";

// Extract data from the decoded JSON
$message = trim($data["message"]);
$contacts = $data["contacts"];

if (empty($message) || empty($contacts)) {
    echo json_encode(["success" => false, "message" => "Message or contacts missing."]);
    exit;
}

// Function to send SMS using Pushbullet API
function sendSms($accessToken, $targetDeviceIden, $phoneNumber, $message)
{
    $url = "https://api.pushbullet.com/v2/texts";

    $payload = json_encode([
        "data" => [
            "target_device_iden" => $targetDeviceIden,
            "addresses" => [$phoneNumber],
            "message" => $message,
        ]
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Access-Token: $accessToken",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return ["error" => $error];
    }

    curl_close($ch);

    return json_decode($response, true);
}

// Send SMS to each contact
$results = [];
$successCount = 0;
$errorCount = 0;

foreach ($contacts as $number) {
    $response = sendSms($accessToken, $targetDeviceIden, $number, $message);

    if (isset($response["iden"])) {
        $results[] = ["number" => $number, "status" => "success"];
        $successCount++;
    } else {
        $errorMessage = $response["error"] ?? "Unknown error";
        $results[] = ["number" => $number, "status" => "failed", "error" => $errorMessage];
        $errorCount++;
    }
}

// Return results
echo json_encode([
    "success" => $successCount > 0,
    "message" => "$successCount SMS sent successfully, $errorCount failed.",
    "details" => $results,
]);
