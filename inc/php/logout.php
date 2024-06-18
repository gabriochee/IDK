<?php   
    session_start(); 
    session_destroy();
    session_unset();
    header("Location: ../../client/not_connected/home.php");// server_modif
    exit();
?>