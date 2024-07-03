<?php require_once('../inc/php/access.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../inc/style/style.css">
    <title>IDK</title>
</head>
<body class="container-fluid min-vh-100 error-background d-flex flex-column text-center align-items-center">
    <main class="container-fluid d-flex no-wrap flex-column">
        <div class="row">
            <div class="col-lg-6 m-auto p-4">
                <a href="<?php echo $direction; ?>"><img src="../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px"></a>
            </div>
        </div>
        <h1>Erreur 500, vous allez être rediriger automatique d'ici 30 secondes vers la page d'acceuil</h1>
    </main>
    <script> setTimeout(function() { window.location.href='../client/not_connected/home.php';}, 5000); // server_modif</script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>