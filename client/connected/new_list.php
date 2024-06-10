<?php
session_start();

if (isset($_SESSION['user_id'])) {
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

<body id="connected_contact">
    <?php require('../../inc/php/db.php'); ?>
    <?php require('../../inc/connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h3 class="mt-1">Créer une liste</h3>
                </div>
            </div>
        </div>
        <div class="contact-form row g-5 justify-content-center mb-4 mx-0">
            <div class="col-sm-6">
                <h5 class="text-center">Nom de votre liste</h5>
                <input type="text" class="form-control" id="listName" name="listName" required>
            </div>

            <div class="col-12">
                <h5 class="text-center">Description</h5>
                <textarea class="form-control" id="description" name="description" rows="5" minlength="15" maxlength="300" required></textarea>
            </div>
        </div>
    </main>
    <?php require('../../inc/connected/footer.php'); ?>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>