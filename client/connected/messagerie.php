<?php 
/*if (!isset($_SESSION['user_id'])) {
    header("Location: ../connected/home.php");
    exit();
}*/
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
<body id="not_connected_contact">
    <?php require_once('../../inc/php/function_messagerie.php'); ?>
    <?php require_once('../../inc/not_connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h3 class="mt-1">Contact</h3>
                </div>
            </div>
        </div>
        <div class="contact-form row g-5 justify-content-center mb-4">
            <div class="col-md-7 col-lg-8">
                <form  method="POST" action="messagerie.php" >
                    <div class="row g-3 justify-content-center">
                        <div class="col-10">
                            <label for="theme" class="form-label">Objet de la demande <span class="text-muted">(Optionel)</span></label>
                            <input type="text" class="form-control" id="titre" name="titre" pattern="[a-zA-ZÀ-ÿ0-9._,;:?!/*€$&@#()' -]{2,40}">
                        </div>
                        <div class="col-10">
                            <label for="message" class="form-label">Votre message</label>
                            <textarea class="form-control" id="message" name="message" rows="15" minlength="15" maxlength="500" required></textarea>
                            <div class="invalid-feedback">Veuillez fournir un message valide.</div>
                        </div>
                        <button class="w-100 btn btn-secondary btn-lg btn-warning border-dark border-2" type="submit" name="submit">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php require_once('../../inc/not_connected/footer.php'); ?>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>