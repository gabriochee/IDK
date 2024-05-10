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
<body>
    <?php require('../../inc/not_connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
        <div class="text-center pt-5 fs-2">
                    <?php 
                        if (isset($_GET['wrong_email'])){
                            echo "cet email a déja été utilisé ";
                        }
                    ?>
                </div>
            <div class="row mt-0 pt-0">
                <div class="col-lg-6 m-auto p-4 mt-0 pt-0">
                    <img src="../../inc/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h3 class="mt-1">S'inscrire</h3>
                </div>
            </div>
        </div>
        <div class="contact-form row g-5 justify-content-center mb-4">
            <div class="col-md-7 col-lg-8">
                <form action="./confirmation_inscription.php" class="needs-validation" id="signin-form" method="post">
                    <div class="row g-3">
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
                            <label for="username" class="form-label">Pseudo</label>
                            <input type="text" class="form-control" id="username" name="username" pattern="{,100}" required>
                            <div class="invalid-feedback">Veuillez fournir un pseudo existant valide.</div>
                        </div>
                        <div class="col-12">
                            <label for="sexe" class="form-label">Sexe</label>
                            <select class="form-select" id="sexe" name="sexe" required>
                                <option value="homme">Homme</option>
                                <option value="femme">Femme</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <div class="col-3">
                                <label for="birthday-day" class="form-label">Jour</label>
                                <input type="number" class="form-control" id="birthday-day" name="birthday-day" min="1" max="31">
                                <div class="invalid-feedback">Veuillez fournir un jour valide.</div>
                            </div>
                            <div class="col-4">
                                <label for="birthday-month" class="form-label">Mois</label>
                                <select class="form-control" name="birthday-month" id="birdthday-month">
                                    <option disabled selected value></option>
                                    <option value="01">janvier</option>
                                    <option value="02">février</option>
                                    <option value="03">mars</option>
                                    <option value="04">avril</option>
                                    <option value="05">mai</option>
                                    <option value="06">juin</option>
                                    <option value="07">juillet</option>
                                    <option value="08">août</option>
                                    <option value="09">septembre</option>
                                    <option value="10">octobre</option>
                                    <option value="11">novembre</option>
                                    <option value="12">décembre</option>
                                </select>
                                <div class="invalid-feedback">Veuillez fournir un mois valide.</div>
                            </div>

                            <div class="col-3">
                                <label for="birthday-year" class="form-label">Année</label>
                                <input type="number" class="form-control" name="birthday-year" id="birdthday-year" min="1900" max="<?php echo (date("Y")); ?>">
                                <div class="invalid-feedback">Veuillez fournir une année valide.</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" pattern="{,100}" required>
                            <div class="invalid-feedback">Veuillez fournir un email valide.</div>
                        </div>
                        <div class="col-12">
                            <label for="phone" class="form-label">Numéro de téléphone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" pattern="{,100}" required>
                            <div class="invalid-feedback">Veuillez fournir un numéro de téléphone valide.</div>
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">Mot de passse</label>
                            <input type="password" class="form-control" id="password" name="password" maxlength="100" required>
                            <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                        </div>
                        <div class="col-12">
                            <label for="password-confirmation" class="form-label">Mot de passe confirmation</label>
                            <input type="password" class="form-control" id="password-confirmation" name="password-confirmation" maxlength="100" required>
                            <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                        </div>
                        <p class="col-12">Newsletter</p>
                        <div class="col-12">
                            <label for="sexe" class="form-label">Newsletter</label>
                            <select class="form-select" name="newsletter" required>
                                <option value="1">J'accepte de reçevoir la Newsletter</option>
                                <option value="0">Je refuse de recevoir la Newsletter</option>
                            </select>
                        </div>
                        <button class="w-100 btn btn-secondary btn-lg btn-warning border-dark border-2" id="signin-btn" type="submit" name="send">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php require('../../inc/not_connected/footer.php'); ?>
    <script src="../../inc/js/signin.js"></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>