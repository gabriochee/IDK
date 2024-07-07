<?php
session_start();
require_once(__DIR__ . '/db.php'); 
require_once(__DIR__ . '/log.php');
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: https://idk2watch.freeddns.org/IDK/client/not_connected/login.php");// server_modif
    exit();
}
$_SESSION['last_activity'] = time();

$location = $_SERVER['REQUEST_URI'];
$origin = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$parsed_location = parse_url($location, PHP_URL_PATH);
$parsed_origin = parse_url($origin, PHP_URL_PATH);
$file_location = pathinfo($parsed_location, PATHINFO_FILENAME);
$file_origin = pathinfo($parsed_origin, PATHINFO_FILENAME);
$segments_location = explode('/', trim($location, '/'));
$segments_origin = explode('/', trim($origin, '/'));

// server_modif
if (in_array("client", $segments_location)) {
    if (in_array("connected", $segments_location)) {
        if (!isset($_SESSION['connected'])) {
            header("Location: https://idk2watch.freeddns.org/IDK/client/not_connected/login.php");
            exit();
        } 
    }
    if (in_array("not_connected", $segments_location)) {
        if (isset($_SESSION['connected']) && $_SESSION['role_user'] !== 'admin') {
            header("Location: https://idk2watch.freeddns.org/IDK/client/connected/home.php");
            exit();
        } 
    }
} 

if (in_array("admin", $segments_location)) {
    if (!isset($_SESSION['connected'])) {
        header("Location: https://idk2watch.freeddns.org/IDK/client/not_connected/login.php");
        exit();
    } 
    if (isset($_SESSION['connected']) && $_SESSION['role_user'] !== 'admin') {
        header("Location: https://idk2watch.freeddns.org/IDK/client/connected/home.php");
        exit();
    }
}

?>

