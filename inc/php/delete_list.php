<?php
require_once('db.php');

session_start();

if (isset($_GET['id_liste'])) {
    $userId = $_SESSION['id_user'];

    $req = $bdd->prepare("SELECT id_user FROM listes WHERE id_liste = :id_liste");
    $req->bindParam(":id_liste", $_GET['id_liste']);
    $req->execute();

    $res = $req->fetch();

    if ($res['id_user'] == $_SESSION['id_user']) {
        $req = $bdd->prepare("DELETE FROM listes WHERE id_liste = :id_liste");
        $req->bindParam(":id_liste", $_GET['id_liste']);
        $req->execute();
        header("Location: ../../client/connected/home.php");
        exit;
    } else {
        header("Location: ../../client/connected/private_list.php?id_liste=" . $_GET['id_liste']);
        exit;
    }

}
