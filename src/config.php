<?php
$url = 'localhost';
$username = 'root';
$password = '';
$dbname = "onlineexam";
$conn = new mysqli($url, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
