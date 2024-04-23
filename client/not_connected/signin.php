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
        <div class="container col-sm-10 col-xl-8">
            <form action="./confirmation.php" class="needs-validation" id="signin-form" method="post">
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
                        </div>

                        <div class="container d-flex align-items-center">
                            <input id="woman" name="gender" type="radio" class="form-check-input bigger-radio border-dark border-1" required value="woman">
                            <label class="form-check-label fs-3 mx-2" for="gender">Femme</label>
                        </div>

                        <div class="container d-flex align-items-center">
                            <input id="other" name="gender" type="radio" class="form-check-input bigger-radio border-dark border-1" required value="other">
                            <label class="form-check-label fs-3 mx-2" for="gender">Autre</label>
                        </div>
                    </div>
                </div>

                <div class="container d-sm-flex justify-content-center justify-content-evenly gap-3 m-0 mt-3">
                    <div class="col-sm-3">
                        <label for="birthday-day" class="form-label fs-3">Jour</label>
                        <input type="number" class="form-control fs-3 border-dark border-2 rounded-3" id="birthday-day" name="birthday-day" min="1" max="31">
                        <div class="invalid-feedback">Veuillez fournir un jour valide.</div>
                    </div>

                    <div class="col-sm-3">
                        <label for="birthday-month" class="form-label fs-3">Mois</label>
                        <select class="form-control fs-3 border-dark border-2 rounded-3" name="birthday-month" id="birdthday-month">
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
                        <input type="number" class="form-control fs-3 border-dark border-2 rounded-3" name="birthday-year" id="birdthday-year" min="1900" max="<?php echo (date("Y")); ?>">
                        <div class="invalid-feedback">Veuillez fournir une année valide.</div>
                    </div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="mail" class="form-label fs-3 m-0 mt-3">Email</label>
                    <input type="email" class="form-control fs-3 border-dark border-2 rounded-3" name="mail" id="mail" maxlength="200" required>
                    <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="password" class="form-label fs-3 m-0 mt-3">Mot de passe</label>
                    <input type="password" class="form-control fs-3 border-dark border-2 rounded-3" name="password" id="password" maxlength="100" required>
                    <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="password-confirmation" class="form-label fs-3 m-0 mt-3">Mot de passe confirmation</label>
                    <input type="password" class="form-control fs-3 border-dark border-2 rounded-3" name="password-confirmation" id="password-confirmation" maxlength="100" required>
                    <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-11 mt-4">
                    <button class="btn btn-lg w-100 py-3 fs-3 btn-warning border-dark border-2" id="signin-btn" type="submit" name="send">S'inscrire</button>
                </div>
            </form>
        </div>

    </main>
    <?php require('../../inc/not_connected/footer.php'); ?>
    <script src="../../inc/js/signin.js"></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>