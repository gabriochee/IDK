<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/functions.php">
    <link rel="stylesheet" href="../inc/style.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>

<body id="home_backoffice" class="backoffice">
    <?php require('../inc/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require('../inc/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive mt-4">
                    <h3>Captchas : </h3>
                    <table class="table table-striped table-sm border border-2 border-dark">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Question</th>
                                <th scope="col">ID Captcha</th>
                                <th scope="col">Réponses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $serverAddress = "152.228.217.19";
                            $username = "distant";
                            $password = "LEG2024IDKdistant!";

                            try {
                                $bdd = new PDO("mysql:host=$serverAddress;dbname=projet;port=3306", $username, $password);
                                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $result = $bdd->query('SELECT question_captcha, reponse_captcha, question_captcha FROM CAPTCHA;');
                                $fetchedResult = $result->fetchAll();
                                foreach ($fetchedResult as $row) {
                                    var_dump($row);
                                    echo '<br>';
                                }
                                var_dump($fetchedResult);
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                                echo '<br>';
                                echo "Code erreur : " . $e->getCode();
                            }

                            ?>
                            <tr>
                                <td>Nombres d'utilisateurs connecté(s) :</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <?php

                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="container-fluid px-0">
                    <h3>Ajouter des captchas</h3>
                    <form action="./confirmation.php" class="needs-validation" id="signin-form" method="post">
                        <div class="container px-0">
                            <label for="question" class="form-label fs-3 m-0 mt-3">Question</label>
                            <input type="text" class="form-control fs-5 border-dark border-2 rounded-3" id="question" name="question" maxlength="200" required>
                            <div class="invalid-feedback">Veuillez fournir une question valide.</div>
                        </div>
                    </form>
                </div>
            </main>

        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../inc/script.js"></script>
</body>

</html>