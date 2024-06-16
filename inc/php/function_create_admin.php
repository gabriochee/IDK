<?php
require('db.php');

if(isset($_POST['create_admin'])) {
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $role_user = $_POST['role_user'];
    $mail = $_POST['mail'];

    $pepper = 'sZB8J0az0z';
    $hash = password_hash($_POST['mdp'] . $pepper, PASSWORD_BCRYPT, ['cost' => 13]);

    $date_inscription = date('Y-m-d H:i:s');

    $req = $bdd->prepare("INSERT INTO utilisateur (role_user, nom, prenom, pseudo, mail, date_inscription, mdp) VALUES (:role_user, :nom, :prenom, :pseudo, :mail, :date_inscription, :mdp)");

    $req->bindParam(':role_user', $role_user);
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':pseudo', $pseudo);
    $req->bindParam(':mail', $mail);
    $req->bindParam(':date_inscription', $date_inscription);
    $req->bindParam(':mdp', $hash);

    if($req->execute()) {
        echo "L'administrateur a été créé avec succès.";
    } else {
        echo "Une erreur est survenue lors de la création de l'administrateur.";
    }
}
?>
