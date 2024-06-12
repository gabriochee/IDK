<?php session_start(); ?>     
<?php require_once('../../inc/php/function_inscription.php'); ?>
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
<body id="not_connected_confirmation_inscription">
    <?php require_once('../../inc/components/not_connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h3 class="mt-5">En cours de confirmation<br>de la création du compte...</h3>
                </div>
            </div>
        </div>
        
    </main>
    <?php require_once('../../inc/components/not_connected/footer.php'); ?>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../inc/js/search_movie.js"></script>
    <script>
        setTimeout(function() {
            window.location.href = 'confirmation_connexion.php';
        }, 5000);
    </script>
</body>
</html>