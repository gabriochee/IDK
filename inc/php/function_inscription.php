<?php

require_once('db.php');
function headerWithError($errorMessage){
    header('HTTP/1.1 307 Temporary Redirect');
    header('location : signin.php?error_message=' . $errorMessage);
    exit;
}

$requiredAttributes = [
    "lastName"              => "prénom",
    "firstName"             => "nom de famille",
    "birthday-year"         => "date d'anniversaire",
    "birthday-month"        => "date d'anniversaire",
    "birthday-day"          => "date d'anniversaire",
    "sexe"                  => "sexe",
    "username"              => "pseudonyme",
    "email"                 => "mail",
    "password"              => "mot de passe",
    "password-confirmation" => "mot de passe de confirmation",
    "phone"                 => "numéro de téléphone"
];

foreach ($requiredAttributes as $attribute => $readable) {
    if (!isset($_POST[$attribute])) {
        headerWithError($readable . " manquant.");
    }
}

if($_POST['password'] != $_POST['password-confirmation']) {
    headerWithError("Le mot de passe et le mot de passe de confirmation ne correspondent pas.");
}

if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $_POST['password'])) {
    headerWithError("Le mot de passe ne répond pas aux critères de sécurité exigés : " . $_POST['password']);
} else if(!preg_match("/^(19[0-9][0-9])|(20[0-1][0-9])|(202[0-4])$/", $_POST['birthday-year']) || !preg_match("/^(0?[1-9]$)|(1[0-2])$/", $_POST['birthday-month']) || !preg_match("/^(0?[1-9]$)|([1-2][0-9])|(3[0-1])$/", $_POST['birthday-day'])) {
    headerWithError("La date de naissance est incorrecte.");
} else if(!preg_match("/^(homme)|(femme)|(autre)$/", $_POST['sexe'])) {
    headerWithError("Le sexe est incorrect.");
} else if(!preg_match("/^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/", $_POST['email'])) {
    headerWithError("Le mail est incorrect.");
} else if(!preg_match("/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/", $_POST["phone"])) {
    headerWithError("Le numéro de téléphone est incorrect.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $pepper = 'sZB8J0az0z';
    $hash = password_hash($_POST['password'].$pepper, PASSWORD_BCRYPT, ['cost' => 13]);
    $today = date('Y-m-d');

    if($_POST['newsletter'] == 1) {
        $newsLetter = 1;
    } else {
        $newsLetter = 0;
    }

    try {
        $photo_utilisateur = "profile.svg";
        $sql = "INSERT INTO utilisateur(role_user, nom, prenom, date_naissance, sexe, pseudo, mail, mdp, date_inscription, statut_newsletter, verification_code, telephone, supprime, photo_utilisateur) VALUES ('utilisateur', :lastname, :firstname, :birthdate, :gender, :username, :mail, :hash, :today, :abonne, NULL, :phone ,0, :photo_utilisateur)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':photo_utilisateur', $photo_utilisateur);
        $stmt->bindParam(':lastname', $_POST['lastName']);
        $stmt->bindParam(':firstname', $_POST['firstName']);
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->bindParam(':gender', $_POST['sexe']);
        $birthdate = $_POST['birthday-year'] . '-' . $_POST['birthday-month'] . '-' . $_POST['birthday-day'];
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':mail', $_POST['email']);
        $stmt->bindParam(':phone', $_POST['phone']);
        $stmt->bindParam(':hash', $hash);
        $stmt->bindParam(':today', $today);
        $stmt->bindParam(':abonne', $newsLetter);
        $stmt->execute();
        
        $req = $bdd->prepare("SELECT mail, mdp, id_user FROM utilisateur WHERE mail = :email;");
        $req->execute( array("email" => $_POST['email']) );
        $reponse = $req->fetch();
        $_SESSION['email'] = $reponse['mail'];
        $_SESSION['id_user'] = $reponse['id_user'];
        //a voir
        $req5 = $bdd->prepare('INSERT INTO listes(date_creation, details, statut, id_user, nom) VALUES (:date_creation, :details, :list_status, :id_user, :nom);');
        $nom_a_voir ="À voir";
        $description_a_voir = "Liste par défaut : Films que j'ai envie de voir";
        $status_a_voir ="default";
        
        $req5->bindParam(":nom", $nom_a_voir);
        $req5->bindParam(":details", $description_a_voir);
        $req5->bindParam(":list_status", $status_a_voir);
        $req5->bindValue(":date_creation", date('Y-m-d H:i:s'));
        $req5->bindParam(":id_user", $_SESSION['id_user']);
        $req5->execute();
        //deja vu
        $req5 = $bdd->prepare('INSERT INTO listes(date_creation, details, statut, id_user, nom) VALUES (:date_creation, :details, :list_status, :id_user, :nom);');
        $nom_vu ="Déjà vu";
        $description_vu = "Liste par défaut : Films que j'ai déjà vu";
        $status_vu ="default";
        
        $req5->bindParam(":nom", $nom_vu);
        $req5->bindParam(":details", $description_vu);
        $req5->bindParam(":list_status", $status_vu);
        $req5->bindValue(":date_creation", date('Y-m-d H:i:s'));
        $req5->bindParam(":id_user", $_SESSION['id_user']);
        $req5->execute();
        //recommandation
        $req5 = $bdd->prepare('INSERT INTO listes(date_creation, details, statut, id_user, nom) VALUES (:date_creation, :details, :list_status, :id_user, :nom);');
        $nom_reco ="Recommendation";
        $description_reco = "";
        $status_reco ="default";
        
        $req5->bindParam(":nom", $nom_reco);
        $req5->bindParam(":details", $description_reco);
        $req5->bindParam(":list_status", $status_reco);
        $req5->bindValue(":date_creation", date('Y-m-d H:i:s'));
        $req5->bindParam(":id_user", $_SESSION['id_user']);
        $req5->execute();
        // fusion
        // $req5 = $bdd->prepare('INSERT INTO listes(date_creation, details, statut, id_user, nom) VALUES (:date_creation, :details, :list_status, :id_user, :nom);');
        // $nom_fusion ="Fusion";
        // $description_fusion = "";
        // $status_fusion ="invisible";
        
        // $req5->bindParam(":nom", $nom_fusion);
        // $req5->bindParam(":details", $description_fusion);
        // $req5->bindParam(":list_status", $status_fusion);
        // $req5->bindValue(":date_creation", date('Y-m-d H:i:s'));
        // $req5->bindParam(":id_user", $_SESSION['id_user']);
        // $req5->execute();

    } catch (PDOException $e) {
        echo $e->getMessage();
        //header('Location: signin.php?wrong_email=true');
    }
}
?>