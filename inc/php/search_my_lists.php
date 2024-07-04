<?php
session_start();
require_once('db.php');

if (isset($_SESSION['id_user']) && isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];

    if (isset($_GET['id_work'])){
        $idWork = $_GET['id_work'];

        $req = $bdd->prepare("SELECT id_liste, nom, IF((SELECT COUNT(id_work) FROM element_liste WHERE id_work = :id_work AND element_liste.id_liste = listes.id_liste) > 0, 1, 0) as contains_work FROM listes WHERE id_user = :id_user AND MATCH (nom) AGAINST (:keyword IN BOOLEAN MODE);");
        $req->bindValue(':id_work', $idWork);
        $req->bindValue(':id_user', $_SESSION['id_user']);
        $req->bindValue(':keyword', '\'' . $keyword . '*\'');
        $req->execute();

        $res = $req->fetchAll();
    } else {
        $req = $bdd->prepare("SELECT id_liste, nom FROM listes WHERE id_user = :id_user AND MATCH (nom) AGAINST (:keyword IN BOOLEAN MODE);");
        $req->bindParam(':id_user', $_SESSION['id_user']);
        $req->bindValue(':keyword', '\'' . $keyword . '*\'');
        $req->execute();

        $res = $req->fetchAll();
    }

    echo json_encode($res);
}