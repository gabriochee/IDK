<?
require_once('db.php');

$authValues = ["privee", "amis seulement", "publique"];

if (isset($_GET['list-status']) && isset($_GET['id-liste']) && in_array($_GET['list-status'], $authValues)){
    $req = $bdd->prepare("UPDATE listes SET statut = :statut WHERE id_liste = :id_liste;");
    $req->bindParam(":statut", '\'' . $_GET['list-status'] . '\'');
    $req->bindParam(":id_liste", $_GET['id-liste']);
    $req->execute();
}