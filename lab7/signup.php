<?php
include 'db.php';

if (isset($_POST['signup'])){ 
    $username = $_POST['username'];
    $password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);
try{
$sql="SELECT studentID 
FROM  student 
WHERE studentID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username );
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows> 0){
$sql = "INSERT INTO users (username,password) VALUES (?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
    echo 'Success';
}
else{
echo'Student ID not found.';
}
}
catch (Exception $e) {
    echo $e->getMessage();
}
}
?>