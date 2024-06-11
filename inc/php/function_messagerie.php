<?php

    if(isset($_POST['submit'])){
        $titre = $_POST['titre'];
        $message = $_POST['message'];
        $req1="INSERT INTO ami(id_user_1, id_user_2) VALUES (:me, :other)";
        $stmt = $bdd->prepare($devenir_ami);
    }

?>