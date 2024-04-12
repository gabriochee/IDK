<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/functions.php">
    <link rel="stylesheet" href="../../inc/style.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>

<body class="no-x-overflow">
    <?php require('../../inc/not_connected/header.php'); ?>

    <main>
        <div class="container-fluid d-flex flex-column text-center">
            <div class="my-5 py-2 gap-5">
                <img src="../../inc/logo.svg" alt="Logo IDK" width="200px" height="200px" class="img img-thumbnail bg-transparent border-0">
            </div>
            <h3 class="mt-5 mx-auto col-6">Voici selon notre algorithme, les cinqs œuvres qui correspond le plus a vos réponses.
                <br>Bon visionnage !
            </h3>
        </div>

        <div class="d-lg-flex row row-cols-lg-6 row-cols-2 row-cols-md-3 gap-3 justify-content-center mt-5 pt-5">
            <?php require('../../inc/components/card.php'); ?>
            <?php require('../../inc/components/card.php'); ?>
            <?php require('../../inc/components/card.php'); ?>
            <?php require('../../inc/components/card.php'); ?>
            <?php require('../../inc/components/card.php'); ?>
        </div>

        <div class="container-fluid d-flex flex-column text-center">
            <h3 class="mt-5 mx-auto col-6 fw-normal">Merci pour votre participation.<br>Pour plus d’options : Inscrivez-vous !</h3>
        </div>

        <div class="container-fluid text-center my-5">
            <a href="#" class="btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-4 col-md-3">S'inscrire</a>
        </div>

    </main>

    <?php require('../../inc/not_connected/footer.php'); ?>

<script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../inc/script.js"></script>
</body>
</html>