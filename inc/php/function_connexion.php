<?php

require_once('db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../inc/library/PHPMailer/src/Exception.php';
require '../../inc/library/PHPMailer/src/PHPMailer.php';
require '../../inc/library/PHPMailer/src/SMTP.php';

$email = $_SESSION['email'];

if(isset($_POST['code'])) {


    $mail = new PHPMailer(true);
    $mail->isSMTP();
    
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'annuelprojet2@gmail.com';
    $mail->Password = 'zwcsygpubwzvaysr';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    
    $mail->setFrom('annuelprojet2@gmail.com');
    $email = $_SESSION['email'];
    $mail->addAddress($email);
    $mail->isHTML(true);

    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    $mail->Subject = 'Email verification';
    $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

    
    $req = $bdd->prepare("UPDATE utilisateur SET verification_code = :verification_code WHERE mail = :email;");
    $req->execute( array("email" => $email, "verification_code" => $verification_code) );
    
    try {
        $mail->send();
        header('Location: confirmation_connexion.php?email_sent=true');
        exit; 
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        echo "Code erreur : " . $e->getCode();
        echo "Erreur lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
    }
}

if(isset($_POST['connect'])) {
    $connect = $_POST['entrer_code'];
    if($connect != "") {
        $email = $_SESSION['email'];
        $req = $bdd->prepare("SELECT mail, verification_code FROM utilisateur WHERE mail = :email;");
        $req->execute( array("email" => $email) );
        $reponse = $req->fetch();
        if($reponse) {
            $verification_code = $reponse['verification_code'];
            if($connect == $verification_code) {
                header('Location: ../connected/home.php');
            } else {
                header('Location: confirmation_connexion.php?wrong_code=true');
            }
        }
    }
}
?>