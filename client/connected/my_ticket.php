<?php require_once('../../inc/php/access.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/style/style.css">
    <link rel="stylesheet" href="../../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="my_ticket">
    <?php require_once('../../inc/php/function_my_ticket.php'); ?>
    <?php require_once('../../inc/components/connected/header.php'); ?>
    <main class="d-flex justify-content-center align-items-center">
        <div class="container col-md-9 col-lg-10 border border-black rounded-2 border-2 mt-3">
            <div class="d-flex flex-column align-items-center p-4">
                <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                <h3 class="mt-1">Mes tickets</h3>
            </div>
            <h1 class="text-center">Historique de mes demandes</h1>
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
                            foreach ($recup_my_tickets as $messages) {
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


                                    echo '<td class="text-center align-middle">' . htmlspecialchars($messages["statut_ticket"]) . '</td>';


                                    echo '<td class="text-center align-middle">
                                    <div class="d-grid gap-2">
                                        <form action="demande_message_user.php" method="GET">
                                        <input type="hidden" name="id_demande" value="'. htmlspecialchars($messages["id"]) .  '">
                                        <button type="submit" class="btn btn-success fs-6 w-100">Voir plus</button>
                                        </form>
                                    </div>
                                    
                                    </td>';
                                    $id_admin = isset($messages["id_admin"]) ? htmlspecialchars($messages["id_admin"]) : 'Non défini';
                                    echo '<td class="text-center align-middle">' . $id_admin . '</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </main>


    <?php require_once('../../inc/components/connected/footer.php'); ?>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>