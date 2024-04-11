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
    <?php require('../../inc/connected/header.php'); ?>

    <main>
        <div class="container-fluid d-flex justify-content-center my-5 py-2">
            <img src="../../inc/logo.svg" alt="Logo IDK" class="img-thumbnail bg-transparent border-0">
        </div>

        <div class="container col-sm-10 col-xl-8">
            <form action="" class="needs-validation" method="post">
                <div class="container d-lg-flex justify-content-center justify-content-evenly">
                    <div class="col-lg-5">
                        <label for="lastname" class="form-label fs-3 m-0">Nom</label>
                        <input type="text" class="form-control fs-3 border-dark border-2 rounded-3" id="lastname" placeholder="" value="" required="">
                        <div class="invalid-feedback">Veuillez fournir un nom valide.</div>
                    </div>

                    <div class="col-lg-5">
                        <label for="firstname" class="form-label fs-3 m-0">Prenom</label>
                        <input type="text" class="form-control fs-3 border-dark border-2 rounded-3" id="firstname" placeholder="" value="" required="">
                        <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                    </div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="phone" class="form-label fs-3 m-0 mt-3">Numéro de téléphone</label>
                    <input type="number" class="form-control fs-3 border-dark border-2 rounded-3" id="phone" placeholder="" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir un numéro de téléphone valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="mail" class="form-label fs-3 m-0 mt-3">Email</label>
                    <input type="email" class="form-control fs-3 border-dark border-2 rounded-3" name="mail" id="mail" required>
                    <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-11">
                    <label for="message" class="form-label fs-3 m-0 mt-3">Message</label>
                    <textarea class="form-control fs-5 border-dark border-2 rounded-3 not-resizable" name="message" id="message" rows="10" cols="50" maxlength="950"></textarea>
                    <div class="invalid-feedback">Veuillez fournir un message valide.</div>
                </div>

                <div class="container d-sm-flex justify-content-center my-3 col-11">
                    <p class="container fs-3 col-lg-5 m-0">Canal de réponse : </p>

                    <div class="d-sm-flex justify-content-center container ps-0">

                        <div class="container d-flex align-items-center">
                            <input id="mail" name="paymentMethod" type="radio" class="form-check-input bigger-radio border-dark border-1" value="mail" required>
                            <label class="form-check-label fs-3 mx-2" for="mail">Mail</label>
                        </div>

                        <div class="container d-flex align-items-center">
                            <input id="message" name="paymentMethod" type="radio" class="form-check-input bigger-radio border-dark border-1" value="message" required>
                            <label class="form-check-label fs-3 mx-2" for="message">Messagerie</label>
                        </div>
                    </div>
                </div>

                <div class="container px-sm-4 col-sm-11 mt-4">
                    <button class="btn btn-lg w-100 py-3 fs-3 btn-warning border-dark border-2" type="submit">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>

    </main>

    <?php require('../../inc/connected/footer.php'); ?>

<script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../inc/script.js"></script>
</body>
</html>