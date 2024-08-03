<?php
include '../src/config_file.php';
include '../src/responseClass.php';

$responseObj = new responseClass();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['token']) && isset($_GET['employee_id'])) {

        $token = $_GET['token'];
        $employee_id = $_GET['employee_id'];

        $sql = $pdo->prepare("SELECT * FROM tokens WHERE token='$token' AND employee_id=$employee_id");
        $result = $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $pdo->prepare("SELECT * FROM employees WHERE id=$employee_id");
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $employee = $sql->fetch(PDO::FETCH_ASSOC);
                $response = $employee;
                $status = 200;
            } else {
                $response = "Employee not found";
                $status = 400;
            }
        } else {
            $response = "Invalid token or employee ID";
            $status = 400;
        }
    } else {
        $response = "Token and employee ID required";
        $status = 400;
    }
} else {
    $response = "Invalid request method";
    $status = 400;
}

$responseObj->respond($response, $status);
