<?php require_once('../inc/php/access.php'); ?>
<?php require_once('../inc/php/function_edit_newsletter.php') ?>
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
    <?php require_once('../inc/components/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/components/backoffice/sidebar.php'); ?>            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container border border-black rounded-2 border-2 mt-3">
                    <h1 class="text-center mt-4">Newsletter</h1>
                    <hr class="featurette-divider my-2">

                        <form action="edit_newsletter.php" method="POST">
                            <div class="my-4">
                                <input type="text" class="form-control mb-3 fs-5" id="subject" name="subject" placeholder="Sujet de la newsletter" required>
                                <textarea class="form-control fs-5" id="corps_message" name="corps_message" rows="7" maxlength="500" placeholder="Corps de la Newsletter" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-warning fs-4 w-100" name="envoyer">Envoyer</button>
                        </form>

                        <h3 class="my-5">Historique :</h3>
                        <div class="table-responsive mb-5">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>ID Newsletter</th>
                                        <th>Sujet - Corps Newsletter</th>
                                        <th>Champ pour mise à jour</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once('../inc/php/fetch_newsletter.php');
                                    foreach ($fetch_newsletter as $newsletter) {
                                        echo '<tr>';
                                            echo '<td class="text-center">' . htmlspecialchars($newsletter["id_bloc"]) . '</td>';
                                            echo '<td class="text-start"><div class="mb-2"><b>Titre :</b> ' . htmlspecialchars($newsletter["titre"]) . '</div><div><b>Corps :</b> ' . htmlspecialchars($newsletter["corps"]) . '</div></td>';
                                            echo '<td>
                                                    <form action="edit_newsletter.php" method="POST">
                                                        <div class="mb-3">
                                                            <label for="subject_update" class="form-label fs-6"><b>Sujet :</b></label>
                                                            <input type="text" required class="form-control fs-6" name="subject_update" value="' . htmlspecialchars($newsletter["titre"]) . '">
                                                            <label for="corps_message_update" class="form-label fs-6 mt-2"<b>Corps :</b></label>
                                                            <textarea class="form-control fs-6" name="corps_message_update" maxlength="500" required>' . htmlspecialchars($newsletter["corps"]) . '</textarea>
                                                        </div>
                                                        <input type="hidden" name="id_newsletter" value="' . htmlspecialchars($newsletter["id_bloc"]) . '">
                                                        <button type="submit" name="update" class="btn btn-warning w-100 fs-6 mt-2">Mettre à jour</button>
                                                    </form>
                                                </td>';
                                            echo '<td class="text-center">
                                                    <div class="d-grid gap-2">
                                                        <form action="edit_newsletter.php" method="POST">
                                                            <input type="hidden" name="id_newsletter" value="' . htmlspecialchars($newsletter["id_bloc"]) . '">
                                                            <button type="submit" name="supress" class="btn btn-danger fs-6 w-100">Supprimer</button>
                                                        </form>
                                                        <form action="edit_newsletter.php" method="POST">
                                                            <input type="hidden" name="subject_hist" value="' . htmlspecialchars($newsletter["titre"]) . '">
                                                            <input type="hidden" name="corps_message_hist" value="' . htmlspecialchars($newsletter["corps"]) . '">
                                                            <button type="submit" name="envoyer_hist" class="btn btn-success fs-6 w-100">Envoyer</button>
                                                        </form>
                                                    </div>
                                                </td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    
                </div>
            </main>
        </div>
    </div>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>