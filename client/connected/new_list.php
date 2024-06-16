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
        <div class="list-form row g-5 justify-content-center mb-4">
            <div class="col-md-7 col-lg-8">
                <form action="../../inc/php/create_list.php" method="POST">
                    <div class="row g-5 justify-content-center mb-4 mx-0">
                        <div class="col-12 input-group">
                            <span class="input-group-text">Nom de votre liste</span>
                            <input type="text" class="form-control" id="list-name" name="list-name" required>
                        </div>
                        <div class="col-12 mt-2">
                            <textarea class="form-control" id="description" name="description" rows="5" maxlength="300" placeholder="Ajoutez une description !"></textarea>
                        </div>

                        <div class="from-check container d-flex justify-content-center mt-3">
                            <input class="form-check-input ms-2" type="radio" name="list-status" id="private-list" value="privee" autocomplete="off" checked>
                            <label class="form-check-label ms-1" for="private-list">Privée</label>

                            <input class="form-check-input ms-2" type="radio" name="list-status" id="only-friends-list" value="amis seulement" autocomplete="off">
                            <label class="form-check-label ms-1" for="only-friends-list">Amis seulement</label>

                            <input class="form-check-input ms-2" type="radio" name="list-status" id="public-list" value="publique" autocomplete="off">
                            <label class="form-check-label ms-1" for="public-list">Publique</label>
                        </div>
                        <div class="col-12 mt-2">
                            <button class="w-100 btn btn-secondary btn-lg btn-warning border-dark border-2 mt-3" type="submit">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php require_once('../../inc/components/connected/footer.php'); ?>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>