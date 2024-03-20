<?php
$host = 'localhost';
$dbname = 'gfms_tesing';
$username = 'root';
$password = 'never';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}