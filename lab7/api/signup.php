<?php
require '../db.php';

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
);

try {
$sql = "SELECT studentID
        FROM student
        WHERE studentID=?";
$stmt = $conn->prepare($sql); #stmt ทำเพราะไม่ไว้ใจข้อมูลที่ user ส่งมา
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
$sql = "INSERT INTO users (username, password)
        VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    http_response_code(201);
    echo 'Success';
}
else {
  http_response_code(400);
  echo 'Student ID not found.';
     }
    }
catch (Exception) {
  http_response_code(500);
  echo 'Server error.';
     }
  }
  else {
    http_response_code(401);
    echo 'Unauthorized';
  }
?>