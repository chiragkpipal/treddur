<?php
include 'db.php';

$msg = '';
$userId = 0;
$login = isset($_COOKIE['user_id'], $_COOKIE['email']) ? 1 : 0;

if ($login) {

    $email = $_COOKIE['email'];
    $userId = $_COOKIE['user_id'];

    $sql = "SELECT * FROM users WHERE id='$userId' AND email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
    $mainrow = $result->fetch_assoc();
    $name = $mainrow['name'];
    $email = $mainrow['email'];
}
}