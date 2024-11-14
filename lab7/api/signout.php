<?php
session_start();
unset($_SESSION['user']);
header('Location: /lab7/signin.html');
exit();
?>