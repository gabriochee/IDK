<?php 
session_start();

if(!(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin')) {
    header("Location: ../../not_connected/login.php");
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
<body id="backoffice_diary_log" class="backoffice">
    <?php require('../inc/php/db.php'); ?>
    <?php require('../inc/backoffice/header.php');?>
    <div class="container-fluid">
        <div class="row">
            <?php require('../inc/backoffice/sidebar.php');?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive mt-4"><!-- ajouter un overflow -->
                    <table class="table table-striped table-sm border border-2 border-dark">
                        <tbody>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td>#123 (id)</td>
                                <td>SUCCED</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td></td>
                                <td>FAILED</td>
                                <td>Pseudo innexistant</td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td>#133 (id)</td>
                                <td>FAILED</td>
                                <td>Erreur mot de passe</td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td>#423 (id)</td>
                                <td>FAILED</td>
                                <td>Erreur captcha</td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td>#123 (id)</td>
                                <td>SUCCED</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td></td>
                                <td>FAILED</td>
                                <td>Pseudo innexistant</td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td>#133 (id)</td>
                                <td>FAILED</td>
                                <td>Erreur mot de passe</td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td>#423 (id)</td>
                                <td>FAILED</td>
                                <td>Erreur captcha</td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td>#123 (id)</td>
                                <td>SUCCED</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td></td>
                                <td>FAILED</td>
                                <td>Pseudo innexistant</td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td>#133 (id)</td>
                                <td>FAILED</td>
                                <td>Erreur mot de passe</td>
                            </tr>
                            <tr>
                                <td>13/04/2024 15:25:03</td>
                                <td>127.254.10.0 255.255.255.240</td>
                                <td>email/pseudo saisie</td>
                                <td>#423 (id)</td>
                                <td>FAILED</td>
                                <td>Erreur captcha</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>