<?php 
if(isset($_SESSION['id_user'])) {
    header("Location: ../connected/home.php");
    exit();
}

require_once('../../inc/php/db.php');
if (isset($_GET['captcha_id']) && isset($_GET['captcha_answer'])){
    $request = $bdd->prepare('SELECT bonne_reponse FROM reponse_captcha JOIN correspondance_captcha ON correspondance_captcha.id_reponse = reponse_captcha.id_reponse WHERE reponse_captcha.id_reponse = :id_reponse AND correspondance_captcha.id_captcha = :id_captcha;');

    $request->bindParam(":id_captcha", $_GET['captcha_id']);
    $request->bindParam(":id_reponse", $_GET['captcha_answer']);

    $request->execute();
    $data = $request->fetch();
    
    if ($data['bonne_reponse'] === 1){
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: confirmation_connexion.php');
    }
}
?>
<?php require_once('../../inc/php/scraping_log.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/style/style.css">
    <link rel="stylesheet" href="../../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="not_connected_captcha_verify">
    <?php require_once('../../inc/php/function_login.php'); ?>
    <header class="container w-100 d-flex justify-content-end mt-5 h-100">
        <button class="nav-link btn">
            <i class="bi bi-moon-stars fs-3" height="100" width="100"></i>
        </button>
    </header>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h4 class="mt-1">Répondez à cette question afin de prouver que vous n'êtes pas un robot.</h4>
                    <hr>
                </div>
            </div>
        </div>

        <div class="container col-sm-6 col-xl-4">
            <form action="captcha_verify.php" class="needs-validation" method="get">
                <div class="container text-center mb-3">
                    <h2>
                        <?php
                        $request = $bdd->query('SELECT id_captcha FROM captcha;');

                        $result = $request->fetchAll();

                        $random_id = $result[rand(0, count($result) - 1)][0];

                        $request = $bdd->query('SELECT question FROM captcha WHERE id_captcha = ' . $random_id . ';');

                        $result = $request->fetch();

                        echo $result['question'];
                        ?>
                    </h2>
                </div>

                <div class="container-fluid d-flex justify-content-center gap-2 p-0">
                    <?php
                    $request = $bdd->query('SELECT reponse_captcha.contenu, reponse_captcha.id_reponse FROM reponse_captcha JOIN correspondance_captcha ON correspondance_captcha.id_reponse = reponse_captcha.id_reponse WHERE correspondance_captcha.id_captcha = ' . $random_id . ';');

                    $result = $request->fetchAll();

                    $i = 0;

                    foreach ($result as $key => $value) {
                        echo '<input type="radio" class="btn-check" name="captcha_answer" value="' . $value['id_reponse'] . '" id="option' . $i . '" autocomplete="off">';
                        echo '<label class="nav-btn btn btn-sm btn-warning border border-dark border-2 rounded-3 fs-sm-5 px-3" for="option' . $i . '">' . $value['contenu'] . '</label>';
                        $i++;
                    }

                    ?>
                </div>

                <div class="container px-sm-4 col-sm-10 mt-5">
                    <button class="btn btn-lg w-100 py-2 fs-4 btn-warning border-dark border-2" type="submit" name="captcha_id" value="<?php echo $random_id; ?>">
                        Valider la réponse
                    </button>
                </div>
            </form>
        </div>
    </main>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>