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
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    foreach ($recup_messages_co as $messages) {
                                        echo '<tr>';
                                            echo '<td class="text-center">' . htmlspecialchars($messages["id"]) . '</td>';
                                            echo '<td class="text-center">' . htmlspecialchars($messages["id_user"]) . '</td>';
                                            echo '<td class="text-center">' . htmlspecialchars($messages["mail"]) . '</td>';
                                            echo '<td class="text-center">' . htmlspecialchars($messages["date_message"]) . '</td>';
                                            echo '<td class="text-center">' . htmlspecialchars($messages["titre"]) . '</td>';
                                            echo '<td class="text-center">' . nl2br(htmlspecialchars($messages["messages"])) . '</td>';
                                            echo '<td class="text-center">
                                                <select name="ticket_status_' . htmlspecialchars($messages["id"]) . '">
                                                    <option value="pas commence">Pas commence</option>
                                                    <option value="en cours">En cours</option>
                                                    <option value="termine">Terminé</option>
                                                </select>
                                            </td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <h1>Historique de demandes utilisateur non connecté</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>ID Demande</th>
                                    <th>Adresse mail</th>
                                    <th>Date Message</th>
                                    <th>Titre</th>
                                    <th>Message</th>
                                    <th>Status ticket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($recup_messages_not_co as $messages) {
                                        echo '<tr>';
                                            echo '<td class="text-center">' . htmlspecialchars($messages["id"]) . '</td>';
                                            echo '<td class="text-center">' . htmlspecialchars($messages["mail"]) . '</td>';
                                            echo '<td class="text-center">' . htmlspecialchars($messages["date_message"]) . '</td>';
                                            echo '<td class="text-center">' . htmlspecialchars($messages["titre"]) . '</td>';
                                            echo '<td class="text-center">' . nl2br(htmlspecialchars($messages["messages"])) . '</td>';
                                            echo '<td class="text-center">
                                                <form action="messagerie_adm.php" method="POST">
                                                    <select name="ticket_status_' . htmlspecialchars($messages["id"]) . '">
                                                        <option value="pas commence">Pas commence</option>
                                                        <option value="en cours">En cours</option>
                                                        <option value="termine">Terminé</option>
                                                    </select>

                                                </form>
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
