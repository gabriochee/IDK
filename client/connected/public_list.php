<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header("Location: ../not_connected/login.php");
    exit();
}
?>
<?php require('../../inc/php/scraping_log.php'); ?>

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
<body id="connected_public_list" class="no-x-overflow">
    <?php require('../../inc/php/db.php'); ?>
    <?php require('../../inc/connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex flex-column text-center">
            <h3 class="mt-5 mx-auto col-6">Liste : Nom de la liste</h3>
            <h5>Publiée le jj/mm/aaaa</h5>
            <p class="fs-6 m-0">Crée le : 12/12/2023 13:12:23</p>
            <p class="fs-6 m-0">Dèrnière maj le : 12/12/2023 13:12:23</p>
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
            </div>
        </div>

        <div class="container-fluid text-center my-5">
            <a href="#" class="btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-4 col-md-3">Partager !</a>
        </div>

        <div class="container-fluid col-10 fs-5 border border-2 border-dark overflow-auto max-height" style="background-color : #CFDBD5;">
            <ul>
                <?php 
                    for ($i = 1; $i <= 11; $i++){
                        echo "<li class='py-2'> Ami $i - <a href='#' class='link-dark link-underline-opacity-0 link-underline-opacity-100-hover'>Ajouter</a></li>";
                    }
                ?>
            </ul>
        </div>
    </main>
    <?php require('../../inc/connected/footer.php'); ?>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>