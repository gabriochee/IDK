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

<body id="connected_contact">
    <?php require_once('../../inc/php/db.php'); ?>
    <?php require_once('../../inc/components/connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h3 class="mt-1">Créer une liste</h3>
                </div>
            </div>
        </div>
        <form action="../../inc/php/create_list.php" method="post">
            <div class="contact-form row g-5 justify-content-center mb-4 mx-0">
                <div class="col-sm-6">
                    <h5 class="text-center">Nom de votre liste</h5>
                    <input type="text" class="form-control" id="listName" name="listName" required>
                </div>

                <div class="col-12">
                    <h5 class="text-center">Description</h5>
                    <textarea class="form-control" id="description" name="description" rows="5" maxlength="300"></textarea>
                </div>
                <button class="w-25 btn btn-secondary btn-lg btn-warning border-dark border-2" type="submit">Envoyer</button>
            </div>
        </form>
    </main>
    <?php require_once('../../inc/components/connected/footer.php'); ?>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>