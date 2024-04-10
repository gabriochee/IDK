<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/style.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>IDK</title>
</head>

<body>
    <?php require('../../inc/not_connected/header.php'); ?>

    <main>
        <div class="container-fluid d-flex justify-content-center gap-5 my-5 py-2">
            <img src="../../inc/movie_card_placeholder.jpg" alt="Logo IDK" class="img img-thumbnail bg-transparent border-3 border-dark rounded-circle">
            <h3 class="my-auto ms-5">Pseudo utilisateur</h3>
        </div>

        <div class="container col-sm-10 col-xl-8">
            <form action="" class="needs-validation" method="post">
                <div class="container d-lg-flex justify-content-center justify-content-evenly">
                    <div class="col-lg-5">
                        <label for="lastname" class="form-label fs-3 m-0">Nom</label>
                        <input type="text" class="form-control fs-1 border-dark border-2 rounded-3" id="lastname" placeholder="" value="" required="">
                        <div class="invalid-feedback">Veuillez fournir un nom valide.</div>
                    </div>

                    <div class="col-lg-5">
                        <label for="firstname" class="form-label fs-3 m-0">Prenom</label>
                        <input type="text" class="form-control fs-1 border-dark border-2 rounded-3" id="firstname" placeholder="" value="" required="">
                        <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                    </div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="username" class="form-label fs-3 m-0 mt-3">Pseudo</label>
                    <input type="text" class="form-control fs-1 border-dark border-2 rounded-3" id="username" placeholder="" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                </div>

                <div class="container d-sm-flex justify-content-center my-3 col-11">
                    <p class="container fs-3 col-sm-2 m-0">Sexe : </p>

                    <div class="d-sm-flex justify-content-center container ps-0">

                        <div class="container d-flex align-items-center">
                            <input id="man" name="paymentMethod" type="radio" class="form-check-input bigger-radio border-dark border-1" required>
                            <label class="form-check-label fs-3 mx-2" for="credit">Homme</label>
                        </div>

                        <div class="container d-flex align-items-center">
                            <input id="woman" name="paymentMethod" type="radio" class="form-check-input bigger-radio border-dark border-1" required>
                            <label class="form-check-label fs-3 mx-2" for="credit">Femme</label>
                        </div>

                        <div class="container d-flex align-items-center">
                            <input id="other" name="paymentMethod" type="radio" class="form-check-input bigger-radio border-dark border-1" required>
                            <label class="form-check-label fs-3 mx-2" for="credit">Autre</label>
                        </div>
                    </div>
                </div>

                <div class="container d-sm-flex justify-content-center justify-content-evenly gap-3 m-0 mt-3">
                    <div class="col-sm-3">
                        <label for="birthday-day" class="form-label fs-3">Jour</label>
                        <input type="number" class="form-control fs-1 border-dark border-2 rounded-3" id="birthday-day" min="1" max="31" value="" required="">
                        <div class="invalid-feedback">Veuillez fournir un jour valide.</div>
                    </div>

                    <div class="col-sm-3">
                        <label for="birthday-month" class="form-label fs-3">Mois</label>
                        <select class="form-control fs-1 border-dark border-2 rounded-3" name="birthday-month" id="birdthday-month">
                            <option disabled selected value></option>
                            <option value="janvier">janvier</option>
                            <option value="fevrier">février</option>
                            <option value="mars">mars</option>
                            <option value="avril">avril</option>
                            <option value="mai">mai</option>
                            <option value="juin">juin</option>
                            <option value="juillet">juillet</option>
                            <option value="aout">août</option>
                            <option value="semptembre">septembre</option>
                            <option value="octobre">octobre</option>
                            <option value="novembre">novembre</option>
                            <option value="decembre">décembre</option>
                        </select>
                        <div class="invalid-feedback">Veuillez fournir un mois valide.</div>
                    </div>

                    <div class="col-sm-3">
                        <label for="birthday-year" class="form-label fs-3">Année</label>
                        <input type="number" class="form-control fs-1 border-dark border-2 rounded-3" name="birthday-year" id="birdthday-year" min="1900" max="<?php echo (date("Y")); ?>">
                        <div class="invalid-feedback">Veuillez fournir une année valide.</div>
                    </div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="mail" class="form-label fs-3 m-0 mt-3">Email</label>
                    <input type="email" class="form-control fs-1 border-dark border-2 rounded-3" name="mail" id="mail" placeholder="" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="password" class="form-label fs-3 m-0 mt-3">Mot de passe</label>
                    <input type="password" class="form-control fs-1 border-dark border-2 rounded-3" name="password" id="password" placeholder="" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="password-confirmation" class="form-label fs-3 m-0 mt-3">Mot de passe confirmation</label>
                    <input type="password" class="form-control fs-1 border-dark border-2 rounded-3" name="password-confirmation" id="password-confirmation" placeholder="" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-11 mt-4">
                    <button class="btn btn-lg w-100 py-3 fs-3 btn-warning border-dark border-2" type="submit">
                        Modifier les informations
                    </button>
                </div>

                <div class="container">
                    <div class="container my-3 col-11">
                        <p class="container fs-3 col-sm-2 m-0">Préférences newsletter : </p>

                        <div class="d-sm-flex container ps-0">

                            <div class="container d-flex align-items-center">
                                <input id="man" name="paymentMethod" type="radio" class="form-check-input bigger-radio border-dark border-1" required>
                                <label class="form-check-label fs-3 mx-2" for="credit">Homme</label>
                            </div>

                            <div class="container d-flex align-items-center">
                                <input id="woman" name="paymentMethod" type="radio" class="form-check-input bigger-radio border-dark border-1" required>
                                <label class="form-check-label fs-3 mx-2" for="credit">Femme</label>
                            </div>

                            <div class="container d-flex align-items-center">
                                <input id="other" name="paymentMethod" type="radio" class="form-check-input bigger-radio border-dark border-1" required>
                                <label class="form-check-label fs-3 mx-2" for="credit">Autre</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </main>

    <?php require('../../inc/not_connected/footer.php'); ?>
</body>

</html>