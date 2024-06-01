<?php
session_start();

$session_lifetime = 1800;


if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_lifetime)) {
    session_unset();
    session_destroy();
    header("Location: ../not_connected/login.php");
    exit();
}
$_SESSION['last_activity'] = time(); 


if (strpos($_SERVER['REQUEST_URI'], '/not_connected/') !== false) {
    if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
        header("Location: home.php");
        exit();
    }
}


if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../not_connected/home.php");
    exit();
}
?>
