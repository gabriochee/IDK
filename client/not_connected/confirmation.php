<?php
if (isset($_POST['lastname'])) {
    if ($_POST['password'] != $_POST['password-confirmation']) {
        header('Location: ./signin.php');
        exit();
    }
}

?>
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
        <div class="container-fluid d-flex justify-content-center">
            <div class="d-flex flex-column my-5 py-2 gap-5 text-center">
                <img src="../../inc/logo.svg" alt="Logo IDK" width="200px" height="200px" class="container-fluid img-thumbnail bg-transparent border-0">
                <h3 class="mt-5">En cours de confirmation<br>de la création du compte...</h3>
            </div>
        </div>
    </main>

    <?php require('../../inc/not_connected/footer.php'); ?>

    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../inc/script.js"></script>
</body>

</html>