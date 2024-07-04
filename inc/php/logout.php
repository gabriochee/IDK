<?php   
    require_once('log.php');

    session_start(); 
    server_log($_SESSION['id_user'] . " a déconnecté son compte");
    session_destroy();
    session_unset();
    header("Location: ../../client/not_connected/home.php");// server_modif
    exit();
?>