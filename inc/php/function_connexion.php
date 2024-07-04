<?php

require_once('db.php');
require_once('log.php');

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
                $_SESSION['id_user'] = $reponse['id_user'];
                $_SESSION['nom'] = $reponse['nom'];
                $_SESSION['prenom'] = $reponse['prenom'];
                $_SESSION['pseudo'] = $reponse['pseudo'];
                $_SESSION['connected'] = 'connected';
                $_SESSION['role_user'] = $reponse['role_user'];
                try {
                    $req_avg_age = $bdd->prepare("SELECT FLOOR(AVG(age_amis)) AS moyenne_age_ami FROM (SELECT TIMESTAMPDIFF(YEAR, u.date_naissance, CURDATE()) AS age_amis FROM ami a INNER JOIN utilisateur u ON a.id_user_2 = u.id_user WHERE a.id_user_1 = :id_user AND u.date_naissance IS NOT NULL) AS ages_amis");
                    $req_avg_age->bindParam(':id_user', $_SESSION['id_user']);
                    $req_avg_age->execute();
                    $avg_age_result = $req_avg_age->fetch(PDO::FETCH_ASSOC); 

                    $req_majority_genre = $bdd->prepare("SELECT u.sexe AS majorite_genre_ami FROM ami a INNER JOIN utilisateur u ON a.id_user_2 = u.id_user WHERE a.id_user_1 = :id_user GROUP BY u.sexe ORDER BY COUNT(*) DESC LIMIT 1");
                    $req_majority_genre->bindParam(':id_user', $_SESSION['id_user']);
                    $req_majority_genre->execute();
                    $majority_genre_result = $req_majority_genre->fetch(PDO::FETCH_ASSOC); 

                    $avg_age = $avg_age_result['moyenne_age_ami'] ?? null; 
                    $majority_genre = $majority_genre_result['majorite_genre_ami'] ?? null; 

                    $sql_update_stats = "UPDATE utilisateur SET moyenne_age_ami = :avg_age, majorite_genre_ami = :majority_gender WHERE id_user = :id_user";
                    $stmt_update_stats = $bdd->prepare($sql_update_stats);
                    $stmt_update_stats->bindParam(':avg_age', $avg_age, PDO::PARAM_STR); 
                    $stmt_update_stats->bindParam(':majority_gender', $majority_genre, PDO::PARAM_STR); 
                    $stmt_update_stats->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT); 
                    $stmt_update_stats->execute(); 
                } catch(PDOException $e) {
                    die($e->getMessage());
                }
                if ($role == 'utilisateur'){
                    $req8 = $bdd->prepare("UPDATE utilisateur SET derniere_connexion = NOW() WHERE mail = :email");
                    $email = $_SESSION['email'];
                    $req8->bindValue(':email', $email, PDO::PARAM_STR);
                    $req8->execute();
                    server_log($_SESSION['id_user'] . " s'est connecté");
                    header('Location: ../connected/home.php');
                    exit;
                } else if ($role == 'admin') {
                    server_log($_SESSION['id_user'] . " s'est connecté en administrateur");
                    header('Location: ../../admin/home.php');
                    exit;
                } else {
                    header('Location: confirmation_connexion.php?wrong_role=true');
                    exit;
                }
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
