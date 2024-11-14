<?php
require '../db.php';

$sql = 'SELECT studentID
        FROM student
        WHERE studentID NOT IN (SELECT username FROM users
        )';
$result = $conn->query($sql);
$data = $result->fetch_all(MYSQLI_ASSOC);
//echo '<pre>';
//var_dump($data);
//echo '</pre>';
$conn->close();
http_response_code(200);
echo json_encode($data);
?>