<?php
session_start();
require 'db.php';
$image = null;
if ($_FILES['image']['name']) {
    $target_file = $_SESSION['user']['studentID'].'.'
       .pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
   if (move_uploaded_file($_FILES["image"]["tmp_name"],
       "images/profiles/$target_file")) {
        $image = $target_file;
    }    
}
$sql = "UPDATE student
SET fristname='{$_POST['fristname']}',
    lastname='{$_POST['lastname']}',
    majorID='{$_POST['majorID']}'"
.($image?", image='$image'":'')
." WHERE studentID='{$_SESSION['user']['studentID']}'";
$conn->query($sql);
header('Location: /lab7/index.php');