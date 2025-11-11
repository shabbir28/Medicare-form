<?php
header('Content-Type: application/json');
include __DIR__ . '/db.php';

$CID          = $_POST['CID'] ?? '';
$ZipCode      = $_POST['ZipCode'] ?? '';
$State        = $_POST['State'] ?? '';
$leadid_token = $_POST['leadid_token'] ?? '';

$errors = [];
if ($ZipCode && !preg_match('/^\d{5}$/', $ZipCode)) {
    $errors[] = "ZIP code must be exactly 5 digits";
}

if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => implode(', ', $errors)], JSON_PRETTY_PRINT);
    exit;
}

$apiUrl = "https://rtb.ringba.com/v1/production/08c0c3d5d72c415481f31ea4ba0831aa.json";
$params = [
    'CID' => $CID,
    'ZipCode' => $ZipCode,
    'State' => $State,
    'leadid_token' => $leadid_token
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl . '?' . http_build_query($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to send message: ' . $error], JSON_PRETTY_PRINT);
    exit;
}

$responseData = json_decode($response, true);
if ($responseData && isset($responseData['status']) && strtolower($responseData['status']) === 'success') {
    $stmt = $conn->prepare("INSERT INTO ringba_leads (CID, ZipCode, State, leadid_token) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $CID, $ZipCode, $State, $leadid_token);
    $stmt->execute();
    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!'], JSON_PRETTY_PRINT);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to send message.'], JSON_PRETTY_PRINT);
}
