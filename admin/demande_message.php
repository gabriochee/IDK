<?php require_once('../inc/php/access.php'); ?>
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
    <?php require_once('../inc/php/db.php') ?>
    <?php require_once('../inc/php/function_messagerie_co.php') ?>
    <?php require_once('../inc/php/function_messagerie_not_co.php') ?>
    <?php require_once('../inc/components/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/components/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container border border-black rounded-2 border-2 mt-3">
                    <h1>Historique de demandes utilisateurs connecté</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>ID Demande</th>
                                    <th>ID Utilisateur</th>
                                    <th>Adresse mail</th>
                                    <th>Date Message</th>
                                    <th>Titre</th>
                                    <th>Message</th>
                                    <th>Status ticket</th>
                                    <th>Voir ticket</th>
                                    <th>Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    foreach ($recup_messages_co as $messages) {
                                        echo '<tr>';
                                            echo '<td class="text-center align-middle">' . htmlspecialchars($messages["id"]) . '</td>';
                                            echo '<td class="text-center align-middle">' . htmlspecialchars($messages["id_user"]) . '</td>';
                                            echo '<td class="text-center align-middle">' . htmlspecialchars($messages["mail"]) . '</td>';
                                            echo '<td class="text-center align-middle">' . htmlspecialchars($messages["date_message"]) . '</td>';
                                            echo '<td class="text-center align-middle">' . htmlspecialchars($messages["titre"]) . '</td>';
                                            echo '<td class="text-center align-middle"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal' . htmlspecialchars($messages["id"]) . '">Voir la demande</button></td>';
                                            
                                            echo '<div class="modal fade" id="messageModal' . htmlspecialchars($messages["id"]) . '" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">';
                                            echo '  <div class="modal-dialog modal-dialog-centered">';
                                            echo '    <div class="modal-content">';
                                            echo '      <div class="modal-header">';
                                            echo '        <h5 class="modal-title" id="messageModalLabel">' . htmlspecialchars($messages["titre"]) . '</h5>';
                                            echo '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                                            echo '      </div>';
                                            echo '      <div class="modal-body ">';
                                            echo '        <p>' . nl2br(htmlspecialchars($messages["messages"])) . '</p>';
                                            echo '      </div>';
                                            echo '      <div class="modal-footer">';
                                            echo '        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>';
                                            echo '      </div>';
                                            echo '    </div>';
                                            echo '  </div>';
                                            echo '</div>';
                                            echo '<td class="text-center align-middle">
                                            
                                                <form action="messagerie_adm.php" method="POST">
                                                    <select name="ticket_status' . htmlspecialchars($messages["id"]) . '">
                                                        <option value="pas commence">Pas commence</option>
                                                        <option value="en cours">En cours</option>
                                                        <option value="termine">Terminé</option>
                                                    </select>
                                                    <button type="submit" name="Statuer_co" class="btn btn-success fs-6 w-100 mt-3">Statuer</button>
                                                </form>
                                            </td>';
                                            echo '<td class="text-center align-middle">
                                                    <div class="d-grid gap-2">
                                                        <form action="messagerie_adm.php" method="POST">
                                                            <input type="hidden" name="envoyer_id_demande" value="'. htmlspecialchars($messages["id"]) .  '">
                                                            <button type="submit" name="envoyer_id_demande_button" class="btn btn-success fs-6 w-100">Voir plus</button>
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
