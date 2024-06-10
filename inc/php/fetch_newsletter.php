<?php
    $req3 = $bdd->prepare("SELECT titre,corps,id_bloc FROM contenu WHERE page_appartenance ='newsletter'");
    $req3->execute();
    $fetch_newsletter = $req3->fetchAll(PDO::FETCH_ASSOC);
?>