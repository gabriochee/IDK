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
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex flex-column text-center">
            <h3 class="mt-5 mx-auto col-6">Liste : Nom de la liste</h3>
            <h5>Publiée le jj/mm/aaaa</h5>
        </div>

        <div class="container mt-sm-0 mt-5">
            <h5>De <a href="#" class="link-dark link-underline-opacity-0 link-underline-opacity-100-hover">Eric123</a>
                <br>
                <br>
                123 abonnées
                <br>
                123 critiques publiques
                <br>
                12 listes publiques
                <br>
                <br>
                inscrit depuis jj/mm/aaaa</h4>
        </div>

        <!-- besoin de changer la taille verticale de cette div, si vous trouvez comment faire dites moi svp. -->
        <div class="container m-0 mt-5 p-0 w-75 list-height m-auto border border-3 border-dark rounded-3 overflow-auto no-overflow-x" style="background-color: #CFDBD5;">
            <div class="d-lg-flex row gx-2 gy-3 px-5 py-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
                <?php require('../../inc/components/card.php'); ?>
                <?php require('../../inc/components/card.php'); ?>
                <?php require('../../inc/components/card.php'); ?>
                <?php require('../../inc/components/card.php'); ?>
                <?php require('../../inc/components/card.php'); ?>
            </div>
        </div>

        <div class="container-fluid text-center my-5">
            <a href="#" class="btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-4 col-md-3">Partager !</a>
        </div>

    </main>
    <?php require('../../inc/not_connected/footer.php'); ?>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>