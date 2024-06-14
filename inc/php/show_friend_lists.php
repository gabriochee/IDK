<?php
// Ce fichier concerne les listes de films des amis et PAS les listes d'amis
session_start();

require_once('db.php');

if (isset($_GET['friendId'])){
    $friendId = $_GET['friendId'];
    $currentUserId = $_SESSION['id_user'];

    $req = $bdd->prepare('SELECT COUNT(id_user_1) > 0 FROM ami WHERE (id_user_1 = :current_id AND id_user_2 = :friend_id) OR (id_user_2 = :current_id AND id_user_1 = :friend_id);');
    $req->bindParam(":friend_id", $friendId);
    $req->bindParam(":current_id", $currentUserId);
    $req->execute();

    $res = $req->fetch();
    if ($res['COUNT(id_user_1) > 0']){
        $req = $bdd->prepare("SELECT id_liste, nom FROM listes WHERE id_user = :friend_id AND statut IN ('publique', 'amis seulement');");
    } else {
        $req = $bdd->prepare("SELECT id_liste, nom FROM listes WHERE id_user = :friend_id AND statut IN ('publique');");
    }
    $req->bindParam(":friend_id", $friendId);
    $req->execute();
    $res = $req->fetchAll();

    echo json_encode($res);
}