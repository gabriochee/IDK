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
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $serverAddress = "152.228.217.19";
                    $username = "distant";
                    $password = "LEG2024IDKdistant!";
                    $bdd;

                    try {
                        $bdd = new PDO("mysql:host=$serverAddress;dbname=projet;port=3306", $username, $password);
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $treated_str = htmlspecialchars($_POST['question']);
                        $bdd->query("INSERT INTO CAPTCHA(question) VALUES ('$treated_str');");
                        $result = $bdd->query('SELECT LAST_INSERT_ID();');
                        $captchaId = $result->fetchAll()[0]['LAST_INSERT_ID()'];
                        $isGoodAnswer = 'false';
                        foreach ($_POST as $key => $answer) {
                            if (str_contains($key, 'good-answer')) {
                                $isGoodAnswer = 'true';
                                continue;
                            }
                            if (str_contains($key, 'answer')) {
                                $bdd->query("INSERT INTO REPONSE_CAPTCHA(contenu, bonne_reponse) VALUES ('$answer', $isGoodAnswer);");
                                $result = $bdd->query('SELECT LAST_INSERT_ID();');
                                $reponseId = $result->fetchAll()[0]['LAST_INSERT_ID()'];
                                $bdd->query("INSERT INTO ASSOCIATION_REPONSES_CAPTCHA(id_captcha, id_reponse) VALUES ($captchaId, $reponseId);");
                            }
                            $isGoodAnswer = 'false';
                        }
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
                ?>
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
                            try {
                                $serverAddress = "152.228.217.19";
                                $username = "distant";
                                $password = "LEG2024IDKdistant!";

                                $bdd = new PDO("mysql:host=$serverAddress;dbname=projet;port=3306", $username, $password);
                                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $data = $bdd->query('SELECT CAPTCHA.question, CAPTCHA.id_captcha, REPONSE_CAPTCHA.contenu 
                                         FROM REPONSE_CAPTCHA
                                         JOIN ASSOCIATION_REPONSES_CAPTCHA
                                         ON ASSOCIATION_REPONSES_CAPTCHA.id_reponse = REPONSE_CAPTCHA.id_reponse
                                         JOIN CAPTCHA
                                         ON ASSOCIATION_REPONSES_CAPTCHA.id_captcha = CAPTCHA.id_captcha;');
                                
                                $fetchedData = $data->fetchAll();

                                if ($fetchedData) {
                                    foreach ($fetchedData as $row) {
                                        echo '<tr>';
                                        for ($i = 0; $i < count($row); $i++) {
                                            echo "<td>" . $row[$i] . "</td>";
                                        }
                                        echo '</tr>';
                                    }
                                }
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="container-fluid px-0">
                    <h3>Ajouter des captchas</h3>
                    <form action="./edit_captcha.php" class="needs-validation" id="signin-form" method="post">
                        <div class="container px-0">
                            <label for="question" class="form-label fs-3 m-0 mt-3">Question</label>
                            <input type="text" class="form-control fs-5 border-dark border-2 rounded-3" id="question" name="question" maxlength="200" required>
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

                                <input type="text" class="form-control fs-5 border-dark border-2 rounded-3" id="answer1" name="answer1" maxlength="200" required>
                                <div class="invalid-feedback">Veuillez fournir une réponse valide.</div>
                            </div>
                        </div>

                        <button type="button" id="add-answer" class="nav-btn btn btn-primary btn-sm btn-warning text-white border border-light border-2 rounded-3 fs-1 mt-5 px-3">+</button>
                        <button type="submit" id="submit-captacha" class="nav-btn btn btn-primary btn-sm btn-success text-white border border-light border-2 rounded-3 fs-4 mt-5 py-3">Enregistrer</button>
                    </form>
                </div>
            </main>

        </div>
    </div>
    <script src="../inc/js/edit_captcha.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>