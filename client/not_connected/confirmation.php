<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    var_dump($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'annuelprojet2@gmail.com';
        $mail->Password = 'zwcsygpubwzvaysr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        
        $mail->setFrom('annuelprojet2@gmail.com');
        $mail->addAddress($_POST["mail"]);

        $mail->isHTML(true);

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $mail->Subject = 'Email verification';
        $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
        $serverAddress = "152.228.217.19";
        $username = "distant";
        $password = "LEG2024IDKdistant!";
        $pepper = 'sZB8J0az0z';
        $hash = password_hash($_POST['password'].$pepper, PASSWORD_BCRYPT, ['cost' => 13]);
        $today = date('Y-m-d');

        try {
            $bdd = new PDO("mysql:host=$serverAddress;dbname=projet;port=3306", $username, $password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $bdd->query(("INSERT INTO UTILISATEUR(role, nom, prenom, date_naissance, genre, pseudo, mail, mdp, date_inscription, photo_utilisateur, statut_newsletter) VALUES ('utilisateur', '{$_POST['lastname']}', '{$_POST['firstname']}', \"{$_POST['birthday-year']}-{$_POST['birthday-month']}-{$_POST['birthday-day']}\", '{$_POST['gender']}', '{$_POST['username']}', '{$_POST['mail']}', '{$hash}', '{$today}', 'N/A', 'abonne');"));
            
            $mail->send();
            echo "
            <script>
            alert('Sent successfully');
            </script>
            "; 
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            echo '<br>';
            echo "Code erreur : " . $e->getCode();
            echo 'salut';
            echo "Erreur lors de l'envoi de l'e-mail : " . $e->getMessage(); // Affiche le message d'erreur générique de PHPMailer
            // Gestion des erreurs d'envoi d'e-mail
            echo "Erreur lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
        }
        
    }


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/functions.php">
    <link rel="stylesheet" href="../../inc/style.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>

<body>
    <?php require('../../inc/not_connected/header.php'); ?>

    <main>
        <div class="container-fluid d-flex justify-content-center">
            <div class="d-flex flex-column my-5 py-2 gap-5 text-center">
                <img src="../../inc/logo.svg" alt="Logo IDK" width="200px" height="200px" class="container-fluid img-thumbnail bg-transparent border-0">
                <h3 class="mt-5">En cours de confirmation<br>de la création du compte...</h3>
            </div>
        </div>
    </main>

    <?php require('../../inc/not_connected/footer.php'); ?>

    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../inc/script.js"></script>
</body>

</html>