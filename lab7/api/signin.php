<?php
session_start();
require '../db.php';

if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = 'SELECT *
            FROM users U JOIN student S
            ON U.username=S.studentID
            WHERE username=?';
    try {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
      if (password_verify($password, $row['password'])) {
      $_SESSION['user'] = [
        'studentID'=>$row['studentID'],
        'firstName'=>$row['firstName'],
        'lastName'=>$row['lastName'],
      ];
      //$_SESSION['studentID'] = $row['studentID'];
      //$_SESSION['firstName'] = $row['firstName'];
      //$_SESSION['lastName'] = $row['lastName'];
      //header('Location: index.php');
      //exit();
      http_response_code(200);
      echo 'Success';
    }
    else {
      http_response_code(401);
      echo 'Password ไม่ถูกต้อง';
    }
}
else {
    http_response_code(401);
    echo 'Username ไม่ถูกต้อง';
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