<?php 
session_start();


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
<body id="connected_questionnaire_results" class="overflox-y-hidden">
    <?php require_once('../../inc/php/db.php'); ?>
    <?php require_once('../../inc/connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h3 class="mt-1">Votre réponse !</h3>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex flex-column text-center">
            <h3 class="mt-5 mx-auto col-6">Voici selon notre algorithme, les cinqs œuvres qui correspond le plus a vos réponses.
                <br>Bon visionnage !
            </h3>
        </div>

        <div class="d-lg-flex row row-cols-lg-6 row-cols-2 row-cols-md-3 gap-3 justify-content-center mt-5 pt-5">
            <?php require_once('../../inc/components/card.php'); ?>
            <?php require_once('../../inc/components/card.php'); ?>
            <?php require_once('../../inc/components/card.php'); ?>
            <?php require_once('../../inc/components/card.php'); ?>
            <?php require_once('../../inc/components/card.php'); ?>
        </div>

        <div class="container-fluid d-flex flex-column text-center">
            <h3 class="mt-5 mx-auto col-6 fw-normal">Merci pour votre participation.<br>Pour plus d’options : Inscrivez-vous !</h3>
        </div>

        <div class="container-fluid text-center mt-5">
            <a href="#" class="btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-4 col-md-3">Fusionner</a>
        </div>

        <div class="container-fluid text-center mb-5 mt-2">
            <a href="#" class="btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-4 col-md-3">Ajouter à une liste</a>
        </div>

        <div class="container-fluid col-10 fs-5 border border-2 border-dark overflow-auto list-list-height" style="background-color : #CFDBD5;">
            <ul>
                <?php 
                    for ($i = 1; $i <= 11; $i++){
                        echo "<li class='py-2'> Liste $i - <a href='#' class='link-dark link-underline-opacity-0 link-underline-opacity-100-hover'>Ajouter</a></li>";
                    }
                ?>
            </ul>
        </div>

    </main>
    <?php require_once('../../inc/connected/footer.php'); ?>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>