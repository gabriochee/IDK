<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['connected']) || $_SESSION['connected'] != 'connected') {exit;}

$id_work = $_GET['id_work'];

try {
    $nameList = $bdd->prepare("SELECT id_liste FROM listes WHERE id_user = :id_user AND nom = 'Recommendation'");
    $nameList->execute(['id_user' => $_SESSION['id_user']]);
    $res_nameList = $nameList->fetch();
    
    if ($res_nameList) {
        $id_list = $res_nameList['id_liste'];

        $insert = $bdd->prepare("INSERT INTO element_liste (id_liste, id_work, date_ajout, detail) VALUES(:id_list, :id_work, NOW(), 'Recherche')");
        $insert->execute([
            'id_list' => $id_list,
            'id_work' => $id_work
        ]);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>