<?php
    require_once('../inc/db.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../client/not_connected/PHPMailer/src/Exception.php';
    require '../client/not_connected/PHPMailer/src/PHPMailer.php';
    require '../client/not_connected/PHPMailer/src/SMTP.php';

    if(isset($_POST['envoyer'])){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'annuelprojet2@gmail.com';
        $mail->Password = 'zwcsygpubwzvaysr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        
        $mail->setFrom('annuelprojet2@gmail.com');
        
        $req = $bdd->prepare("SELECT mail FROM UTILISATEUR WHERE statut_newsletter ='1'");
        $req->execute();
        $emails = $req->fetchAll(PDO::FETCH_COLUMN);
        // Configuration de l'e-mail en dehors de la boucle
        $mail->isHTML(true);
        $mail->Subject= $_POST["subject"];
        $mail->Body= $_POST["query-prompt"];
        foreach ($emails as $email) {
            $mail->addAddress($email);
            
        }
        $mail->send(); 
        
        // Affichage du résultat de fetch
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/functions.php">
    <link rel="stylesheet" href="../inc/style.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="backoffice_diary_log" class="backoffice">
    <?php require('../inc/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require('../inc/backoffice/sidebar.php'); ?>
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
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>