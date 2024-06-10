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
<body id="connected_contact">
    <?php require('../../inc/php/db.php'); ?>
    <?php require('../../inc/connected/header.php'); ?>
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
                <form  method="post" id="form-contact">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="sexe" class="form-label">Sexe</label>
                            <select class="form-select" id="sexe" name="sexe" required>
                                <option value="Mr">Homme</option>
                                <option value="Mme">Femme</option>
                                <option value="Mme">Autre</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-ZÀ-ÿ0-9.' -]{2,40}" required>
                            <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-ZÀ-ÿ0-9.' -]{2,40}" required>
                            <div class="invalid-feedback">Veuillez fournir un nom valide.</div>
                        </div>
                        <div class="col-12">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input type="pseudo" class="form-control" id="pseudo" name="pseudo" pattern="[a-zA-ZÀ-ÿ0-9.' -]{2,40}" required>
                            <div class="invalid-feedback">Veuillez fournir un pseudo existant.</div>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" pattern="{,100}"required>
                            <div class="invalid-feedback">Veuillez fournir un email valide.</div>
                        </div>
                        <div class="col-12">
                            <label for="number" class="form-label">Numéro de portable <span class="text-muted">(Optionel)</span></label>
                            <input type="text" class="form-control" id="number" name="number" pattern="[0-9]{10}">
                            <div class="invalid-feedback">Veuillez fournir un numéro de téléphone valide.</div>
                        </div>
                        <div class="col-12">
                            <label for="theme" class="form-label">Objet de la demande <span class="text-muted">(Optionel)</span></label>
                            <input type="text" class="form-control" id="theme" name="theme" pattern="[a-zA-ZÀ-ÿ0-9._,;:?!/*€$&@#()' -]{2,40}">
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">Votre message</label>
                            <textarea class="form-control" id="message" name="message" rows="15" minlength="15" maxlength="500" required></textarea>
                            <div class="invalid-feedback">Veuillez fournir un message valide.</div>
                        </div>
                        <div class="col-12">
                            <label for="reponse_canal" class="form-label">Canal de réponse</label>
                            <select class="form-select" id="reponse_canal" name="reponse_canal" required>
                                <option value="email">Mail</option>
                                <option value="message">Messagerie</option>
                            </select>
                        </div>
                        <button class="w-100 btn btn-secondary btn-lg btn-warning border-dark border-2" type="submit">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php require('../../inc/connected/footer.php'); ?>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
