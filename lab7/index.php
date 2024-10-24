<?php
session_start();
if (!isset($_SESSION['user'])){
    header('location: signin.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Welcome
<?php
 echo $_SESSION['user']['firstName'].' '.
    $_SESSION ['user']['lastName'];
?>
 </h1>
 <button onclick="signout()">Sign out</button>
 <script>
    function signout(){
        location.href = 'signout.php';
        //assign('signout.php');
    }
</script>
</body>
</html>