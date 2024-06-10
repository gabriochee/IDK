<?php
    require('db.php');
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../inc/library/PHPMailer/src/Exception.php';
    require '../inc/library/PHPMailer/src/PHPMailer.php';
    require '../inc/library/PHPMailer/src/SMTP.php';

    
    //supprimer une newsletter
    if(isset($_POST['supress'])){
        $id_to_suppress = $_POST['id_newsletter'];
        $req4 = $bdd->prepare("DELETE FROM contenu WHERE id_bloc = :id_bloc");
        $req4->bindParam(':id_bloc', $id_to_suppress);
        $req4->execute();
    }
    

    //update la newsletter
    if(isset($_POST['update'])){
        $id_to_update = $_POST['id_newsletter'];
        $subject_update = $_POST['subject_update'];
        $corps_message_update = $_POST['corps_message_update'];
    
        $req4 = $bdd->prepare("UPDATE contenu SET titre = :subject_update, corps = :corps_message_update WHERE id_bloc = :id_bloc");
        $req4->bindParam(':subject_update', $subject_update);
        $req4->bindParam(':corps_message_update', $corps_message_update);
        $req4->bindParam(':id_bloc', $id_to_update);
        $req4->execute();
    }
    
    
    
    if(isset($_POST['envoyer_hist'])){
        try{
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'annuelprojet2@gmail.com';
            $mail->Password = 'zwcsygpubwzvaysr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            
            $mail->setFrom('annuelprojet2@gmail.com');
            //requête pour recup ceux qui sont abonnées
            $req1_emails = $bdd->prepare("SELECT mail FROM utilisateur WHERE statut_newsletter ='1'");
            $req1_emails->execute();
            $emails = $req1_emails->fetchAll(PDO::FETCH_COLUMN);
            // Configuration de l'e-mail en dehors de la boucle
            $mail->isHTML(true);
    
            $mail->Subject = $_POST["subject_hist"];
            $mail->Body = $_POST["corps_message_hist"];
    
            //envoie à chaque mail qui sont abonnés
            foreach ($emails as $email) {
                $mail->addAddress($email);
            }
    
            // Try sending the email
            if ($mail->send()) {
                echo "Le message a été envoyé avec succès";
            } else {
                echo "Erreur lors de l'envoi du message : " . $mail->ErrorInfo;
            }
    
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi du message : " . $mail->ErrorInfo;
        }
    }
    

    //envoyer newsletter
    if(isset($_POST['envoyer'])){
        try{
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'annuelprojet2@gmail.com';
            $mail->Password = 'zwcsygpubwzvaysr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            
            $mail->setFrom('annuelprojet2@gmail.com');
            //requête pour recup ceux qui sont abonnées
            $req1_emails = $bdd->prepare("SELECT mail FROM utilisateur WHERE statut_newsletter ='1'");
            $req1_emails->execute();
            $emails = $req1_emails->fetchAll(PDO::FETCH_COLUMN);
            // Configuration de l'e-mail en dehors de la boucle
            $mail->isHTML(true);

            
            $mail->Subject= $_POST["subject"];
            $mail->Body= $_POST["corps_message"];
            
            
    
            //envoie à chaque mail qui sont abonnés
            foreach ($emails as $email) {
                $mail->addAddress($email);
            }
    
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi du message : " . $mail->ErrorInfo;
        }

        try {
            //si le mail a réussi a envoyer enregistrer les données dans la bdd dans contenu
            if ($mail->send()) {
                $req2_news = $bdd->prepare("INSERT INTO contenu( page_appartenance, titre, corps, last_titre, last_corps) VALUES ('newsletter', :sujet, :corps, :last_titre, :last_corps) ");
                $req2_news->bindParam(':sujet', $_POST["subject"]);
                $req2_news->bindParam(':corps', $_POST["corps_message"]);
                $req2_news->bindParam(':last_titre', $_POST["subject"]);
                $req2_news->bindParam(':last_corps', $_POST["corps_message"]);
                $req2_news->execute();
                echo "Le message a été envoyé avec succès";
                
            } else {
                echo "Erreur lors de l'envoi du message : " . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi du message : " . $mail->ErrorInfo;
        }
        
        
    }
?>