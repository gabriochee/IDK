<?php   
session_start(); 
session_destroy();
session_unset();
header("Location: ../not_connected/home.php");
exit();
?>