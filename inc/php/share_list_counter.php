<?php 
require_once('db.php');

if (isset($_GET['idListe'])){
    $req = $bdd->prepare('UPDATE listes SET partages = partages + 1 WHERE id_liste = :idListe;');
    $req->bindParam(':idListe', $_GET['idListe']);
    $req->execute();
}