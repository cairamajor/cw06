<?php
$host = "localhost";
$user = "cmajor7";
$pass = "cmajor7";
$db   = "cmajor7";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DB Error: " . $conn->connect_error);
}
?>