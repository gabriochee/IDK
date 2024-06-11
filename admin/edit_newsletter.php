<?php
session_start();

/*if(!(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin')) {
    header("Location: ../client/not_connected/login.php");
    exit();
}*/
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
            <?php require('../inc/backoffice/sidebar.php'); ?>
            <?php require('../inc/php/function_edit_newsletter.php') ?>
            
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="mt-4">
                    <h1>Historique de Newsletter</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>ID Newsletter</th>
                                    <th>Sujet Newsletter</th>
                                    <th>Corps Newsletter</th>
                                    <th>champ pour update</th>
                                    <th>button suppress</th>
                                    <th>envoyer</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                require_once('../inc/php/fetch_newsletter.php');
                                foreach ($fetch_newsletter as $newsletter) {
                                    echo '<tr>';
                                        echo '<td class ="text-center">' . htmlspecialchars($newsletter["id_bloc"]) . '</td>';
                                        echo '<td class ="text-center">' . htmlspecialchars($newsletter["titre"]) . '</td>';
                                        echo '<td class ="text-center">' . htmlspecialchars($newsletter["corps"]) . '</td>';
                                        echo '<td>
                                                <form action="edit_newsletter.php" method="POST">
                                                    <div class="mt-5">
                                                        <label for="subject_update" class="form-label fs-5">Sujet</label>
                                                        <input type="text" required class="form-control fs-5" name="subject_update" value="' . htmlspecialchars($newsletter["titre"]) . '">
                                    
                                                        <label for="corps_message_update" class="form-label fs-5 ">Corps de la Newsletter</label>
                                                        <textarea class="form-control "  name="corps_message_update" maxlength="500" required>' . htmlspecialchars($newsletter["corps"]) . '</textarea>
                                                    </div>
                                                    
                                                    <input type="hidden" name="id_newsletter" value="' . htmlspecialchars($newsletter["id_bloc"]) . '">
                                                    <button type="submit" name="update" class="btn btn-primary fs-4 mt-3">Update</button>
                                                </form>
                                            </td>';
                                        echo '  <td class ="text-center">
                                                    <form action="edit_newsletter.php" method="POST">
                                                        <input type="hidden" name="id_newsletter" value="' . htmlspecialchars($newsletter["id_bloc"]) . '">
                                                        <button type="submit" name="supress" class="btn btn-primary fs-4 mt-3">Supprimer</button>
                                                    </form>
                                                </td>';
                                        echo '  <td class ="text-center">
                                                    <form action="edit_newsletter.php" method="POST">
                                                        <input type="hidden" name="subject_hist" value="' . htmlspecialchars($newsletter["titre"]) . '">
                                                        <input type="hidden" name="corps_message_hist" value="' . htmlspecialchars($newsletter["corps"]) . '">
                                                        <button type="submit" name="envoyer_hist" class="btn btn-primary fs-4 mt-3">Envoyer</button>
                                                    </form>
                                                </td>';
                                    echo '</tr>';
                                    
                                }
                                
                                ?>
                            </tbody>
                            
                        </table>
                    </div>

                    <form action="edit_newsletter.php" method="POST">
                        <div class="mt-5">
                            <label for="subject" class="form-label fs-4">Sujet</label>
                            <input type="text" class="form-control fs-5" id="subject" name="subject" placeholder="Sujet de la newsletter" required>

                            <label for="corps_message" class="form-label fs-4 mt-3">Corps de la Newsletter</label>
                            <textarea class="form-control fs-5" id="corps_message" name="corps_message" rows="7" minlength="0" maxlength="500" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary fs-4 mt-3" name="envoyer">Envoyer</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
