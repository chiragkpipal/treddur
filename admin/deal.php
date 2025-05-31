<?php

include 'login-check.php'; 

if ($_GET['add'] == 1) {
    $deal = 1;
} else {
    $deal = 0;
}
$tid = $_GET['id'];
$sql = "UPDATE tires SET deals = '$deal' WHERE id = '$tid'";
mysqli_query($conn, $sql);
header('Location: tires.php');
exit;