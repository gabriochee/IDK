<?php
require_once('db.php');
require_once('log.php');

session_start();

if (isset($_POST['list-name'])){

    try {
        $req = $bdd->prepare('INSERT INTO listes(date_creation, details, statut, id_user, nom) VALUES (:date_creation, :details, :list_status, :id_user, :nom);');
        $req->bindValue(":date_creation", date('Y-m-d H:i:s'));
        $req->bindParam(":details", $_POST['description']);
        $req->bindParam(":list_status", $_POST['list-status']);
        $req->bindParam(":id_user", $_SESSION['id_user']);
        $req->bindParam(":nom", $_POST['list-name']);
        $req->execute();

        $req = $bdd->prepare('SELECT MAX(id_liste) FROM listes;');
        $req->execute();

        $id = $req->fetch()["MAX(id_liste)"];

        $req->execute();

        server_log("Création nouvelle liste(" . $id . ") par " . $_SESSION['id_user']);
        header("Location: ../../client/connected/private_list.php?id_liste={$id}");
        exit();

    } catch (PDOException $e){
        echo $e->getMessage();
    }
}