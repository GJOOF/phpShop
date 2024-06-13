<?php
// db_connection.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    die();
}
?>
