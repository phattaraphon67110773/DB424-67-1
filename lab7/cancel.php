<?php
session_start();
require 'db.php';
$activityID = $_GET['id'];
$sql = '
select * 
from register
where activityID=?
and studentID=?';
$stm = $conn->prepare($sql);
$stm->bind_param('ss',
    $activityID, $_SESSION['user']['studentID']);
$stm->execute();
$result = $stm->get_result();
if ($row = $result->fetch_assoc()){
  $conn->begin_transaction();
  try {
    $sql = 'delete from register 
            where activityID=?
            and studentID=?';
    $stm = $conn->prepare($sql);
    $stm->bind_param('ss', $activityID,
                            $_SESSION['user']['studentID']);
    $stm->execute();
    $sql = 'update activity set available=available+1
            where activityID=?';
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $activityID);
    $stm->execute();
    $conn->commit();
    header('location:activity.php');
  }
  catch  (Exception) {
    $conn->rollback();
    http_response_code(500);
    header('location:activity.php');


  }
}
else {
    http_response_code(400);
    header('location:activity.php');
}
