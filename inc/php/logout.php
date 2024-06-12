<?php   
session_start(); 
session_destroy();
session_unset();
header("Location: http://localhost:8888/IDK/client/not_connected/home.php");
exit();
?>