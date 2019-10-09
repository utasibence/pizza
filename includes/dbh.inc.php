<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "pizza";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
$conn->set_charset('utf8');

if ($conn->connect_error) {
    die("Csatlakozási hiba: " . $conn->connect_error);
}
