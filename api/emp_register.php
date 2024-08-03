<?php
include '../src/config_file.php';

$name = $_POST['name'];
$email = $_POST['email'];
// $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$password = $_POST['password'];
$response = '';

// Insert employee data
$sql = $pdo->prepare("INSERT INTO employees (name, email, password) VALUES ('$name', '$email', '$password')");
if ($sql->execute()) {

    $employee_id = $pdo->lastInsertId(); //get last inserted emp id to create token

    $token = bin2hex(random_bytes(16)); //create random token id

    $sql = $pdo->prepare("INSERT INTO tokens (employee_id, token) VALUES ($employee_id, '$token')");
    if ($sql->execute()) {
        $response =  "Registration successful. Your token is: $token";
    } else {
        $response =  "Error: " . $sql . "<br>" . $pdo->errorInfo();
    }
} else {
    $response =  "Error: " . $sql . "<br>" . $pdo->errorInfo();
}


echo ($response);
