<?php
// SCRAPPING 
require_once('log.php');

$root_path = __FILE__;
$parent_path = dirname(dirname($root_path));
$relative_path = str_replace($parent_path, '', $root_path);

server_log("Consultation de la page " . $relative_path);

// ACCES CO NO-CO ADMIN 
require_once(__DIR__ . '/db.php'); 

$url_demandee = $_SERVER['REQUEST_URI'];
$segments_url = explode('/', trim($url_demandee, '/'));
define("RACINE", "/IDK");

$exception_client = ['confirmation_connexion.php', 'confirmation_inscription.php', 'login.php', 'sigin.php'];
$exception_inc = ['confirmation_connexion.php', 'delete_list.php'];

if (in_array("inc", $segments_url)) {
    if (empty(array_intersect($segments_url, $exception_inc))) {
        header("Location: " . RACINE . "/inc/error/error500.php");
        exit();
    }
}

if (in_array("admin", $segments_url)) {
    if (!isset($_SESSION['id_user'])) {
        header("Location: " . RACINE . "/client/not_connected/login.php");
        exit();
    } 
    if (isset($_SESSION['id_user']) && $_SESSION['role_user'] !== 'admin') {
        header("Location: " . RACINE . "/client/connected/home.php");
        exit();
    }
}

if (in_array("client", $segments_url)) {
    if (in_array("connected", $segments_url)) {
        if (!isset($_SESSION['id_user'])) {
            header("Location: " . RACINE . "/client/not_connected/login.php");
            exit();
        } 
    }
    if (in_array("not_connected", $segments_url) && empty(array_intersect($segments_url, $exception_client))) {
        if (isset($_SESSION['id_user'])) {
            header("Location: " . RACINE . "/client/connected/home.php");
            exit();
        } 
    }
}

if (in_array("error", $segments_url)) {
    if (isset($_SESSION['id_user'])) { 
        if ($_SESSION['role_user'] == 'admin') { 
            $direction = RACINE . '/admin/home_backoffice.php';
        } else {
            $direction = RACINE . '/client/connected/home.php';
        } 
    } else { 
        $direction = RACINE . '/client/not_connected/home.php';
    }
    // header("Location: " . $direction);
    // exit();
    // rediriger dans le fichier 404 et 500
}
?>

