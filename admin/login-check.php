<?php
include 'db.php';
$ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
$currenturl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$login = isset($_COOKIE['admin_id'], $_COOKIE['adminusername']) ? 1 : 0;

if ($login) {

    $username = $_COOKIE['adminusername'];
    $adminId = $_COOKIE['admin_id'];

    $sql = "SELECT * FROM admins WHERE id='$adminId' AND username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
    $mainrow = $result->fetch_assoc();
    $username = $mainrow['username'];
    $email = $mainrow['email'];

    }
} else {
    header('Location: login.php');
    exit();
}