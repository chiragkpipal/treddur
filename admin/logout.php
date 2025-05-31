<?php
setcookie('adminusername', '', time() - 360000, '/');
setcookie('admin_id', '', time() - 360000, "/");

$expire = time() - 360000;

// Iterate through all cookies and delete them
foreach ($_COOKIE as $key => $value) {
    setcookie($key, '', $expire, '/');
}

session_start();
session_destroy();

// Redirect to a login page or any other desired page after logout
header("Location: login.php");
exit;

