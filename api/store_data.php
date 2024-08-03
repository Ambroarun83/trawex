<?php
include '../src/config_file.php';

$postData = file_get_contents('php://input'); // Retrieve the raw POST data 
$data = json_decode($postData, true); // Decode the JSON data
$jsonString = json_encode($data['jsonData']); // encode the raw json data to store

// Prepare and bind
$stmt = $pdo->prepare("INSERT INTO json_table (json_data) VALUES (?)");
$stmt->bindParam(1, $jsonString, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->errorInfo();
}
