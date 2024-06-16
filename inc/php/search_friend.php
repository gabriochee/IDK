<?php

session_start();

require_once('db.php');

if (isset($_GET['friend_keyword'])){
    $friendKeyword = $_GET['friend_keyword'];
    $userId = $_SESSION['id_user'];

    $req = $bdd->prepare("SELECT id_user, pseudo FROM utilisateur JOIN ami ON ami.id_user_1 = utilisateur.id_user OR ami.id_user_2 = utilisateur.id_user WHERE (id_user_1 = :id_user OR id_user_2 = :id_user) AND id_user != :id_user AND MATCH (pseudo) AGAINST (:friend_keyword IN BOOLEAN MODE) GROUP BY (:id_user);");
    $req->bindParam(":id_user", $userId);
    $req->bindValue(":friend_keyword", '\'' . $friendKeyword . '*\'');
    $req->execute();

    $res = $req->fetchAll();

    echo json_encode($res);
    exit();
}

