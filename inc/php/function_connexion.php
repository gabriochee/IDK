<?php

require_once('db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../inc/library/PHPMailer/src/Exception.php';
require '../../inc/library/PHPMailer/src/PHPMailer.php';
require '../../inc/library/PHPMailer/src/SMTP.php';

$email = isset($_SESSION['email']) ? $_SESSION['email'] : handle_error('Entrer sur la page confirmation_connexion sans avoir suivi le chemin classique via la page login');

if (isset($_POST['code'])) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'annuelprojet2@gmail.com';
    $mail->Password = 'zwcsygpubwzvaysr';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    
    $mail->setFrom('annuelprojet2@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true);

    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    $mail->Subject = 'Email verification';
    $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

    try {
        $req = $bdd->prepare("UPDATE utilisateur SET verification_code = :verification_code WHERE mail = :email;");
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->bindValue(':verification_code', $verification_code, PDO::PARAM_STR);
        $req->execute();
        if ($req->rowCount() > 0) {
            if ($mail->send()) {
                header('Location: confirmation_connexion.php?email_sent=true');
                exit;
            } else {
                header('Location: confirmation_connexion.php?mail_error=true&error=' . urlencode($mail->ErrorInfo));
                exit;
            }
        } else {
            header('Location: confirmation_connexion.php?update_failed=true');
            exit;
        }
    } catch (PDOException $e) {
        header('Location: confirmation_connexion.php?db_error=true&error=' . urlencode($e->getMessage()));
        exit;
    } catch (Exception $e) {
        header('Location: confirmation_connexion.php?mail_error=true&error=' . urlencode($e->getMessage()));
        exit;
    }
}

if (isset($_POST['connect'])) {
    
    $connect = $_POST['entrer_code'];
    if ($connect != "") {
        $email = $_SESSION['email'];
        $req = $bdd->prepare("SELECT id_user, nom, prenom, pseudo, mail, verification_code, role_user FROM utilisateur WHERE mail = :email;");
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        $reponse = $req->fetch();
        
        if ($reponse) {
            $verification_code = $reponse['verification_code'];
            if ($connect == $verification_code) {
                $role = $reponse['role_user'];
                if($role == 'utilisateur'){
                    $req8 = $bdd->prepare("UPDATE utilisateur SET derniere_connexion = NOW() WHERE mail = :email");
                    $email = $_SESSION['email'];
                    $req8->bindValue(':email', $email, PDO::PARAM_STR);
                    $req8->execute();
                    header('Location: ../connected/home.php');
                } else if ($role == 'admin') {
                    header('Location: ../../admin/home.php');
                } else {
                    header('Location: confirmation_connexion.php?wrong_role=true');
                }
                $_SESSION['id_user'] = $reponse['id_user'];
                $_SESSION['nom'] = $reponse['nom'];
                $_SESSION['prenom'] = $reponse['prenom'];
                $_SESSION['pseudo'] = $reponse['pseudo'];
                $_SESSION['connected'] = 'connected';
                $_SESSION['role_user'] = $reponse['role_user'];
                exit;
            } else {
                header('Location: confirmation_connexion.php?wrong_code=true');
                exit;
            }
        } else {
            header('Location: confirmation_connexion.php?no_user=true');
            exit;
        }
    }
}
?>
