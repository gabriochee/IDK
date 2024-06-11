<?php
require_once('db.php');

session_start();

if (isset($_POST['listName'])){

    $req = $bdd->prepare('INSERT INTO listes(date_creation, details, statut, id_user, nom) VALUES (:date_creation, :details, NULL, :id_user, :nom);');
    $req->bindValue(":date_creation", date('Y-m-d H:i:s'));
    $req->bindParam(":details", $_POST['description']);
    $req->bindParam(":id_user", $_SESSION['id_user']);
    $req->bindParam(":nom", $_POST['listName']);

    $req = $bdd->prepare('SELECT MAX(id_liste) FROM listes;');
    $req->execute();

    $id = $req->fetch()["MAX(id_liste)"];

    $req->execute();
    header("Location: ../../client/connected/private_list.php?id_liste={$id}");
    exit();
}