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
        
        $req1 = $bdd->prepare("SELECT mail FROM utilisateur WHERE statut_newsletter ='1'");
        $req1->execute();
        $emails = $req1->fetchAll(PDO::FETCH_COLUMN);
        // Configuration de l'e-mail en dehors de la boucle
        $mail->isHTML(true);
        $mail->Subject= $_POST["subject"];
        $mail->Body= $_POST["corps_message"];
        //envoie à chaque mail qui sont abonnés
        foreach ($emails as $email) {
            $mail->addAddress($email);
        }
        try {
            if ($mail->send()) {
                $req2 = $bdd->prepare("INSERT INTO contenu( page_appartenance, titre, corps, last_titre, last_corps) VALUES ('newsletter', :sujet, :corps, :last_titre, :last_corps) ");
                $req2->bindParam(':sujet', $_POST["subject"]);
                $req2->bindParam(':corps', $_POST["corps_message"]);
                $req2->bindParam(':last_titre', $_POST["subject"]);
                $req2->bindParam(':last_corps', $_POST["corps_message"]);
                $req2->execute();
                echo "Le message a été envoyé avec succès";
            } else {
                echo "Erreur lors de l'envoi du message : " . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi du message : " . $mail->ErrorInfo;
        }
        
    }
?>