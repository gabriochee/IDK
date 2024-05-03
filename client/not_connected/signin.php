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
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h3 class="mt-1">S'inscrire</h3>
                </div>
            </div>
        </div>
<<<<<<< HEAD

        <div class="container col-sm-10 col-xl-8">
            <form action="./confirmation_inscription.php" class="needs-validation" id="signin-form" method="post">
                <div class="container d-lg-flex justify-content-center justify-content-evenly">
                    <div class="col-lg-5">
                        <label for="lastname" class="form-label fs-3 m-0">Nom</label>
                        <input type="text" class="form-control fs-3 border-dark border-2 rounded-3" id="lastname" name="lastname" maxlength="100" required>
                        <div class="invalid-feedback">Veuillez fournir un nom valide.</div>
                    </div>

                    <div class="col-lg-5">
                        <label for="firstname" class="form-label fs-3 m-0">Prenom</label>
                        <input type="text" class="form-control fs-3 border-dark border-2 rounded-3" id="firstname" name="firstname" maxlength="100" required>
                        <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                    </div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="username" class="form-label fs-3 m-0 mt-3">Pseudo</label>
                    <input type="text" class="form-control fs-3 border-dark border-2 rounded-3" id="username" name="username" maxlength="100" required>
                    <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                </div>

                <div class="container d-sm-flex justify-content-center my-3 col-11">
                    <p class="container fs-3 col-sm-2 m-0">Sexe : </p>

                    <div class="d-sm-flex justify-content-center container ps-0">

                        <div class="container d-flex align-items-center">
                            <input id="man" name="gender" type="radio" class="form-check-input bigger-radio border-dark border-1" required value="man">
                            <label class="form-check-label fs-3 mx-2" for="gender">Homme</label>
=======
        <div class="contact-form row g-5 justify-content-center mb-4">
            <div class="col-md-7 col-lg-8">
                <form action="./confirmation.php" class="needs-validation" id="signin-form" method="post">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-ZÀ-ÿ0-9.' -]{2,40}" required>
                            <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
>>>>>>> ba71503596b7da4659b3667a8b7341760ffe0bda
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
                        <div class="container d-sm-flex justify-content-center justify-content-evenly gap-3 m-0 mt-3">
                            <div class="col-sm-3">
                                <label for="birthday-day" class="form-label fs-3">Jour</label>
                                <input type="number" class="form-control" id="birthday-day" name="birthday-day" min="1" max="31">
                                <div class="invalid-feedback">Veuillez fournir un jour valide.</div>
                            </div>
                            <div class="col-sm-3">
                                <label for="birthday-month" class="form-label fs-3">Mois</label>
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

                            <div class="col-sm-3">
                                <label for="birthday-year" class="form-label fs-3">Année</label>
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