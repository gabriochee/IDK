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
<body id="backoffice_demande_message_adm" class="backoffice">
    <?php require_once('../inc/php/db.php') ?>
    <?php require_once('../inc/php/function_demande_message.php') ?>
    <?php require_once('../inc/components/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/components/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table table-striped table-sm border border-3 border-dark rounded-2 border-2 mt-3">
                    <div class="row justify-content-center">
                        <div class="col-12 ">
                            <h1 class="text-center bg-dark text-light">Ticket n°<?php echo htmlspecialchars($recup_ticket['id_demande']);?> de Mr.<?php echo htmlspecialchars($recup_ticket['pseudo']);?> </h1>
                            <h1 class="text-center bg-dark text-light">Etat du ticket: <?php echo htmlspecialchars($recup_ticket['statut_ticket']);?> </h1>
                            <h2 class="mx-3">Titre demande: <?php echo htmlspecialchars($recup_ticket['titre_demande']);?> </h2>
                            <p class="mx-3">Contenu de la demande:</p>
                            <div class="mx-3 mb-3">
                                <?php echo nl2br('<div class="mx-3">' . str_replace("\n", '</div><div class="mx-3">', htmlspecialchars($recup_ticket['message_demande'])) . '</div>'); ?>
                            </div>

                            
                        </div>
                    </div>
                </div>


                <div class="table table-striped table-sm border border-3 border-dark rounded-2 border-2 mt-3 ">
                    <div class="row justify-content-center">
                        <div class="col-12 ">
                            <h1 class="text-center bg-dark text-light">Messages du ticket n°<?php echo htmlspecialchars($recup_ticket['id_demande']);?></h1>
                            
                            <div class="container my-2 overflow-y-auto" style="max-height: 400px;">
                                <?php foreach ($recup_message as $message): ?>
                                    <?php
                                    if ($message['etre_admin'] == 1) {
                                        $rowClass = 'justify-content-end';
                                        $alertClass = 'alert-primary';
                                        $role = 'Admin';
                                    } else {
                                        $rowClass = 'justify-content-start';
                                        $alertClass = 'alert-secondary';
                                        $role = 'Utilisateur';
                                    }
                                    ?>
                                    <div class="row <?php echo $rowClass; ?>">
                                        <div class="col-auto">
                                            <div class="alert <?php echo $alertClass; ?>" role="alert">
                                                <p class="mb-0"><strong><?php echo $role; ?></strong></p>
                                                Message : <?php echo nl2br(htmlspecialchars($message['message'])); ?><br>
                                                Date : <?php echo htmlspecialchars($message['date_message']); ?><br>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            
                        </div>
                    </div>
                </div>
                <div class="table table-striped table-sm border border-3 border-dark rounded-2 border-2 mt-3 ">
                    <div class="row justify-content-center">
                        <div class="col-12 ">
                            <h4 class="text-center bg-dark text-light">Envoyer un message</h4>
                            <form action="demande_message.php" method="GET">
                                <div class="my-4">
                                    <textarea class="form-control fs-5" id="corps_message" name="corps_message" rows="7" maxlength="500" placeholder="Message" required></textarea>
                                </div>
                                <?php echo '<input type="hidden" name="id_demande" value="'. htmlspecialchars($recup_ticket["id_demande"]) .  '">'?>
                                <button type="submit" class="btn btn-sm btn-warning fs-4 w-100" name="envoyer_demande">Envoyer</button>
                            </form>
                            

                            
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
