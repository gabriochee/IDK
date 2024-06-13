<?php   
session_start(); 
session_destroy();
session_unset();
header("Location: http://localhost/Projet_annuel/IDK-2/client/not_connected/home.php");
exit();
?>