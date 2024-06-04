<?php

$data_user1 = $bdd->prepare("SELECT id_user, nom, prenom, pseudo, sexe, date_naissance, date_inscription, statut_newsletter, telephone, mail FROM utilisateur WHERE id_user = :id_user;");
$data_user1->execute( array( "id_user" => $_SESSION['id_user']) );
$rep_data_user1 = $data_user1->fetch();

$data_user2 = $bdd->prepare("SELECT count(*) FROM ami WHERE id_user_1 = :id_user OR id_user_2 = :id_user;");
$data_user2->execute( array( "id_user" => $_SESSION['id_user']) );
$rep_data_user2 = $data_user2->fetch();

?>
