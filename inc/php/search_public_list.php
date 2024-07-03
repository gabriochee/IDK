<?php
require_once('db.php');

if (isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
    $req = $bdd->prepare("SELECT id_liste, nom FROM listes WHERE statut = 'publique' AND MATCH (nom) AGAINST (:keyword IN BOOLEAN MODE);");
    $req->bindValue(':keyword', '\''. $keyword . '*\'');
    $req->execute();

    $res = $req->fetchAll();

    echo json_encode($res);
}