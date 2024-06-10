<?php

require('db.php');

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
        $sql = "INSERT INTO utilisateur(role_user, nom, prenom, date_naissance, sexe, pseudo, mail, mdp, date_inscription, photo_utilisateur, statut_newsletter, verification_code, telephone, supprime) VALUES ('utilisateur', :lastname, :firstname, :birthdate, :gender, :username, :mail, :hash, :today, 'N/A', :abonne, NULL, :phone ,0)";
        $stmt = $bdd->prepare($sql);
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
    } catch (PDOException $e) {
        echo $e->getMessage();
        //header('Location: signin.php?wrong_email=true');
    }
}
?>