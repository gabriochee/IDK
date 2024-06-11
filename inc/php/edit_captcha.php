<?php

require_once('db.php');

if(empty($_POST) ){ $_POST = json_decode(file_get_contents('php://input'), true);}

if (!isset($_POST['question']) || !isset($_POST['answers'])){exit;}

foreach ($_POST['question'] as $id => $question) {
    try {
        $requete = $bdd->prepare("UPDATE captcha SET question = :question WHERE id_captcha = :id_captcha;");
        $requete->bindParam(':question', $question);
        $requete->bindParam(':id_captcha', $id);
        $requete->execute();
    } catch (PDOException $e){
        echo $e->getMessage();
        exit;
    }
}

echo '<tbody><tr><th>Réponses</th></tr>';

foreach ($_POST['answers'] as $id => $answer) {
    echo '<tr answer-id="' . $id . '"><td ';
    if ($answer[1]){
        echo 'class="d-flex justify-content-between table-success"><input class="form-control bg-success-subtle border border-1 border-secondary-subtle" value="' . $answer[0] .'"><span class="badge bg-success ms-2 me-2">Bonne réponse</span><button class="btn btn-secondary" type="button" title="Changer de bonne réponse" onclick="changeGoodAnswer(this)"><i class="bi bi-x-lg"></i></button>';
    } else {
        echo '><input class="form-control" value="' . $answer[0] . '">';
    }
    echo '</td></tr>';

    try {
        $requete = $bdd->prepare("UPDATE reponse_captcha SET contenu = :contenu, bonne_reponse = :bonne_reponse WHERE id_reponse = :id_reponse;");
        $requete->bindParam(':contenu', $answer[0]);
        $requete->bindValue(':bonne_reponse', (int)$answer[1]);
        $requete->bindParam(':id_reponse', $id);
        $requete->execute();
    } catch (PDOException $e){
        echo $e->getMessage();
        exit;
    }
}

echo '</tbody>';