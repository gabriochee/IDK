<?php   
session_start(); 
session_destroy();
session_unset();
<<<<<<< HEAD
header("Location: http://localhost/Projet_annuel/IDK-2/client/not_connected/home.php");
=======
header("Location: http://localhost:3000/IDK/client/not_connected/home.php");
>>>>>>> 5db287b192d00e5f470d1924b2ed9f07e8a0ad2b
exit();
?>