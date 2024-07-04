<?php
require_once('db.php');
session_start();

if (isset($_GET['mv']) && isset($_GET['id_liste'])){
    $mv = $_GET['mv'];
    $idListe = $_GET['id_liste'];

    $req = $bdd->prepare("SELECT id_user FROM listes WHERE id_liste = :id_liste;");
    $req->bindParam(":id_liste", $idListe);
    $req->execute();

    $isOwner = $req->fetch()['id_user'] == $_SESSION['id_user'];

    $req = $bdd->prepare("SELECT primaryTitle, startYear FROM work_basics WHERE id_work = :id_work;");
    $req->bindParam(':id_work', $mv);
    $req->execute();

    $res = $req->fetch();

    $filmName = $res['primaryTitle'];
    $filmId = $mv;
    $filmYear = $res['startYear'];
    require('../../inc/components/card.php');
}