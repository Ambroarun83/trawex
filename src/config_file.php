<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "trawex";

// PDO Connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Optional: Set PDO error mode
} catch (PDOException $e) {
    die("Error in database connection: " . $e->getMessage());
}
