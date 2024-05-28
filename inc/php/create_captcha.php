<?php

require_once('db.php');

if(empty($_POST) ){ $_POST = json_decode(file_get_contents('php://input'), true);}

if (!isset($_POST['question']) || !isset($_POST['answers'])){exit;}

try {
    $request = $bdd->prepare("INSERT INTO captcha(question) VALUES (:question);");
    $request->bindParam(":question", $_POST['question']);
    $request->execute();

   echo '<div class="card"><div class="card-body d-flex justify-content-between"><input class="form-control me-2" maxlength="150" value="' . htmlspecialchars($_POST['question']) . '"><a class="btn btn-light collapsed" data-bs-toggle="collapse" href="#collapse0" role="button" aria-expended="false" aria-controls="#collapse0" aria-expanded="false">Réponses</a></div></div><div id="collapse0" class="collapse" style=""><div class="card card-body"><table class="table table-bordered"><tbody><tr><th>Réponses</th></tr>';

    $result = $bdd->query('SELECT LAST_INSERT_ID();');
    $captchaId = $result->fetchAll()[0]['LAST_INSERT_ID()'];

    foreach ($_POST['answers'] as $answer) {
        $request = $bdd->prepare("INSERT INTO reponse_captcha(contenu, bonne_reponse) VALUES (:answer, :good_answer);");
        $request->bindParam(":answer", $answer['answer']);
        $request->bindValue(":good_answer", (int)$answer['good_answer']);
        $request->execute();

        $result = $bdd->query('SELECT LAST_INSERT_ID();');
        $reponseId = $result->fetchAll()[0]['LAST_INSERT_ID()'];
        $bdd->query("INSERT INTO correspondance_captcha(id_captcha, id_reponse) VALUES ($captchaId, $reponseId);");

        if ((int)$answer['good_answer']){
            echo '<tr answer-id="' . $reponseId . '"><td class="d-flex justify-content-between table-success"><input maxlength="150" class="form-control bg-success-subtle border border-1 border-secondary-subtle" value="' . htmlspecialchars($answer['answer']) . '"><span class="badge bg-success ms-2 me-2">Bonne réponse</span><button class="btn btn-secondary" type="button" title="Changer de bonne réponse" onclick="changeGoodAnswer(this)"><i class="bi bi-x-lg"></i></button></td></tr>';
        } else {
            echo '<tr answer-id="' . $reponseId . '"><td><input maxlength="150" class="form-control" value="' . htmlspecialchars($answer['answer']) . '"></td></tr>';
        }
    }

    echo '</tbody></table><div><button type="button" class="delete-btn nav-btn btn btn-primary btn-sm btn-danger text-white border border-2 rounded-3 px-3" onclick="deleteCaptcha(this)" value="' . $captchaId . '">Supprimer</button><button type="button" class="nav-btn btn btn-primary btn-sm text-white border-light rounded-3 px-3 modify-btn btn-warning ms-2" onclick="modifyCaptcha(this)" value="' . $captchaId . '">Modifier</button></div></div></div>';
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

