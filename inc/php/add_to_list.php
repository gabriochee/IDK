<?php
require_once('db.php');

if (isset($_GET['id_work']) && isset($_GET['id_liste'])){
    $id_work = $_GET['id_work'];
    $id_liste = $_GET['id_liste'];
    $test_req = $bdd->prepare("SELECT COUNT(id_liste) FROM element_liste WHERE id_liste = :id_liste AND id_work = :id_work;");
    $test_req->bindParam(':id_work', $id_work);
    $test_req->bindParam(':id_liste', $id_liste);
    $test_req->execute();

    if (!$test_req->fetch()['COUNT(id_liste)']) {
        $req = $bdd->prepare("INSERT INTO element_liste(id_liste, id_work, date_ajout) VALUES (:id_liste, :id_work, :date_ajout);");
        $req->bindParam(":id_liste", $id_liste);
        $req->bindParam(":id_work", $id_work);
        $req->bindValue(":date_ajout", date("Y-m-d H:i:s"));

        $req->execute();
        echo json_encode([]);
    } else {
        echo json_encode(["error" => "Cet élément est déjà présent dans la liste."]);
    }
}