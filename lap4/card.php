<?php
$dok = explode(',', 'spade,hearts,clube,diams');
$tam =explode(',',  'A,2,3,4,5,6,7,8,9,J,Q,K');
$dack = [];
foreach($tam as $t){
    foreach($dok as $d){
        $deck[] = ['tam'=>$t, 'dok'=>$d];
    }
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>poker</title>
</head>
<body>
    <pre>
        <?php print_r($deck); ?>
    <h1>ไพ่ที่ได้</h1>
    <span>x</span> + <span>x</span>

    
</body>
</html>