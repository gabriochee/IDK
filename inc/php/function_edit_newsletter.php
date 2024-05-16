<?php
    require_once('db.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../inc/library/PHPMailer/src/Exception.php';
    require '../inc/library/PHPMailer/src/PHPMailer.php';
    require '../inc/library/PHPMailer/src/SMTP.php';

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