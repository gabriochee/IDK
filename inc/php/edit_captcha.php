<?php

require('db.php');

foreach ($_POST as $key => $value){
    if (str_contains($key, "answer")){
        $answer_id = str_replace("answer-", "", $key);
        $requete = $bdd->prepare("UPDATE reponse_captcha SET contenu = :contenu WHERE id_reponse = :id_reponse;");
        $requete->bindParam(':contenu', $value);
        $requete->bindParam(':id_reponse', $answer_id);
        $requete->execute();
    } else if (str_contains($key, "question")){
        $question_id = str_replace("question-", "", $key);
        $requete = $bdd->prepare("UPDATE captcha SET question = :question WHERE id_captcha = :id_captcha;");
        $requete->bindParam(':question', $value);
        $requete->bindParam(':id_captcha', $question_id);
        $requete->execute();
    }
}