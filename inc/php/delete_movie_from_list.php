<?php
require_once('db.php');

if (isset($_GET['movie-id']) && isset($_GET['list-id'])){
    $req = $bdd->prepare("DELETE FROM element_liste WHERE id_liste = :id_liste AND id_work = :id_work;");
    $req->bindParam(":id_liste", $_GET['list-id']);
    $req->bindParam(":id_work", $_GET['movie-id']);
    $req->execute();
}