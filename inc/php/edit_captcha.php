<?php

require('db.php');

if( empty($_POST) ){ $_POST = json_decode(file_get_contents('php://input'), true);}

if (!isset($_POST['question']) || !isset($_POST['answers'])){exit;}

foreach ($_POST['question'] as $id => $question) {
    $requete = $bdd->prepare("UPDATE captcha SET question = :question WHERE id_captcha = :id_captcha;");
    $requete->bindParam(':question', $question);
    $requete->bindParam(':id_captcha', $id);
    $requete->execute();
}

foreach ($_POST['answers'] as $id => $answer) {
    $requete = $bdd->prepare("UPDATE reponse_captcha SET contenu = :contenu, bonne_reponse = :bonne_reponse WHERE id_reponse = :id_reponse;");
    $requete->bindParam(':contenu', $answer[0]);
    $requete->bindValue(':bonne_reponse', (int)$answer[1]);
    $requete->bindParam(':id_reponse', $id);
    $requete->execute();
}
