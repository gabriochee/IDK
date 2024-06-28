<?php require_once('../../inc/php/access.php'); ?>
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
    <?php require_once('../../inc/php/db.php'); ?>
    <?php require_once('../../inc/components/connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                </div>
            </div>
        </div>
        <h3 class="text-center mb-3">Rechercher une liste publique : </h3>
        <div class="container">
            <input type="search" class="form-control border border-2 border-dark mb-4" oninput="searchPublicList(this.value)" placeholder="Rechercher..." aria-label="Search">
        </div>
        <div class="container d-flex flex-column" id="lists-container">

        </div>
    </main>
    <?php require_once('../../inc/components/connected/footer.php'); ?>
    <script src="../../inc/js/search_public_list.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>