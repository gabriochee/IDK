<?php

require_once('db.php');

try {

    if (isset($_GET['deleteCaptchaId'])) {

        $dlt_id = $_GET['deleteCaptchaId'];

        $request = $bdd->prepare('SELECT reponse_captcha.id_reponse FROM reponse_captcha JOIN correspondance_captcha ON reponse_captcha.id_reponse = correspondance_captcha.id_reponse WHERE id_captcha = :dlt_id;');

        $request->bindParam(":dlt_id", $dlt_id);
        $data = $request->fetchAll();

        $request = $bdd->prepare('DELETE FROM correspondance_captcha WHERE id_captcha = :dlt_id;');

        $request->bindParam(":dlt_id", $dlt_id);

        $request = $bdd->prepare('DELETE FROM captcha WHERE id_captcha = :dlt_id;');

        $request->bindParam(":dlt_id", $dlt_id);

        foreach ($data as $val) {
            $request = $bdd->prepare('DELETE FROM reponse_captcha WHERE id_reponse = :dlt_id;');
            $request->bindParam(":dlt_id", $val['id_reponse']);
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
