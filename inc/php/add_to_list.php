<?php
require_once('db.php');

var_dump($_GET);

if (isset($_GET['id_work']) && isset($_GET['id_liste'])){
    $req = $bdd->prepare("INSERT INTO element_liste(id_liste, id_work, date_ajout) VALUES (:id_liste, :id_work, :date_ajout);");
    $req->bindParam(":id_liste", $_GET['id_liste']);
    $req->bindParam(":id_work", $_GET['id_work']);
    $req->bindValue(":date_ajout", date("Y-m-d H:i:s"));

    $req->execute();
}