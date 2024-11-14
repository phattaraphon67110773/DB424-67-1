<?php
include 'header.php';

?>


    <h1>Welcome
<?php
    echo $_SESSION['user']['firstName'].' '.
         $_SESSION['user']['lastName'];
?>        
    </h1>
   <?php
   include 'footer.php';
   ?>

   