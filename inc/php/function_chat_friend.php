<?php
require_once("db.php");

try {
    $req1 = $bdd->prepare(" SELECT pseudo, nom, prenom, id_user, photo_utilisateur FROM utilisateur 
        INNER JOIN ami 
        ON (utilisateur.id_user = ami.id_user_1 AND ami.id_user_2 = :me) 
        OR (utilisateur.id_user = ami.id_user_2 AND ami.id_user_1 = :me) 
        WHERE utilisateur.id_user != :me
    ");
    $req1->execute(['me' => $_SESSION['id_user']]);
    $rep1 = $req1->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($rep1);
    echo "<script>let friendData = $json;</script>";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>