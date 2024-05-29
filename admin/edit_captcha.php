<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/style/style.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="backoffice_edit_captcha">
    <?php require('../inc/php/db.php'); ?>
    <?php require('../inc/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require('../inc/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive mt-4" id="captcha-table">
                    <h3>Captcha</h3>
                </div>
                <div class="container-fluid px-0">
                    <h3>Ajouter des captchas</h3>
                    <div class="container px-0">
                        <label for="question" class="form-label fs-3 m-0 mt-3">Question</label>
                        <input type="text" class="form-control fs-5 border-dark border-2 rounded-3" id="question" name="question" maxlength="150" required>
                        <div class="invalid-feedback">Veuillez fournir une question valide.</div>
                    </div>

                    <div class="container px-0" id="answers">
                        <div id="answer">
                            <div class="container d-flex align-items-center justify-content-between px-0 mt-3">
                                <div class="d-flex align-items-center px-0 mx-0">
                                    <label for="answer1" class="form-label fs-3 m-0">Réponse 1</label>
                                    <input name="good-answer" type="radio" class="form-check-input bigger-radio border-dark border-1 align-items-center my-0 ms-3" required value="good-answer">
                                    <label class="form-check-label fs-5 mx-2" for="good-answer">Bonne réponse</label>
                                </div>

                                <button type="button" class="delete-btn nav-btn btn btn-primary btn-sm btn-danger text-white border border-light border-2 rounded-3 px-3" onclick="deleteAnswer(this)">Supprimer</button>
                            </div>

                            <input type="text" class="form-control fs-5 border-dark border-2 rounded-3" id="answer1" name="answer1" maxlength="150" required>
                            <div class="invalid-feedback">Veuillez fournir une réponse valide.</div>
                        </div>
                    </div>

                    <button type="button" id="add-answer" class="nav-btn btn btn-primary btn-sm btn-warning text-white border border-light border-2 rounded-3 fs-1 mt-5 px-3">+</button>
                    <button type="button" id="submit-captacha" class="nav-btn btn btn-primary btn-sm btn-success text-white border border-light border-2 rounded-3 fs-4 mt-5 py-3" onclick="createCaptcha(this)">Enregistrer</button>
                </div>
            </main>
        </div>
    </div>
    <?php
    try {
        require_once('../inc/php/db.php');

        $data = $bdd->query('SELECT captcha.question, captcha.id_captcha, reponse_captcha.contenu, reponse_captcha.bonne_reponse, reponse_captcha.id_reponse
                                         FROM reponse_captcha
                                         JOIN correspondance_captcha
                                         ON correspondance_captcha.id_reponse = reponse_captcha.id_reponse
                                         JOIN captcha
                                         ON correspondance_captcha.id_captcha = captcha.id_captcha;');

        $fetchedData = $data->fetchAll();
        $json = json_encode($fetchedData);
        echo "<script>let captchaData = $json;</script>";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
    <script src="../inc/js/edit_captcha.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>