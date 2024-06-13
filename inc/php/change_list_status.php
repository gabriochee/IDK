<?
require_once('db.php');

$authValues = ["privee", "amis seulement", "publique"];

if (isset($_GET['list_status']) && isset($_GET['id_liste'])){
    $statut = $_GET['list_status'];
    $idListe = $_GET['id_liste'];

    $req = $bdd->prepare("UPDATE listes SET statut = :statut WHERE id_liste = :id_liste;");
    $req->bindValue(":statut", '\'' . $statut . '\'');
    $req->bindParam(":id_liste", $idListe);
    $req->execute();
}