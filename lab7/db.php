<?php
$host = 'db403-mysql';
$user = 'root';
$password = 'P@ssw0rd';
$dbname = 'DPU1';

// สร้างการเชื่อมต่อ MySQLi
$conn = new mysqli($host, $user, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_errno) {
    die("Connection failed: " . $conn->connect_error);
}
?>