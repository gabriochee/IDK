<?php 
session_start();

if(!(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin')) {
    header("Location: ../client/not_connected/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/style/style.css">
    <link rel="stylesheet" href="../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="backoffice_edit_newsletter" class="backoffice">
    <?php require_once('../inc/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/backoffice/sidebar.php'); ?>
            <?php require_once('../inc/php/function_edit_newsletter.php') ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive mt-4"><!-- ajouter un overflow -->
                    <form action="edit_newsletter.php" method="POST">
                        <div class="col-12">
                            <label for="query-prompt" class="form-label fs-2">Newsletter</label>
                            <input type="text" class="form-control fs-3" placeholder="subject" name ="subject" value="" required="">
                            <textarea class="form-control fs-3" id="query-prompt" name="query-prompt" rows="7" minlength="0" maxlength="500" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary fs-2 mt-5" name ="envoyer">Envoyer</button>
                        <button type="button" class="btn btn-danger fs-2 mt-5" id="clear-button">Effacer</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="../inc/js/database_editor.js"></script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>