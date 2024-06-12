<?php
    require_once('db.php');
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../inc/library/PHPMailer/src/Exception.php';
    require '../inc/library/PHPMailer/src/PHPMailer.php';
    require '../inc/library/PHPMailer/src/SMTP.php';

    // Supprimer une newsletter
    if (isset($_POST['supress'])) {
        $id_to_suppress = $_POST['id_newsletter'];
        $req7 = $bdd->prepare("DELETE FROM administration_contenu WHERE id_bloc = :id_bloc");
        $req7->bindParam(':id_bloc', $id_to_suppress);
        $req7->execute();

        
        $req4 = $bdd->prepare("DELETE FROM contenu WHERE id_bloc = :id_bloc");
        $req4->bindParam(':id_bloc', $id_to_suppress);
        $req4->execute();
    }

    // Mettre à jour la newsletter
    if (isset($_POST['update'])) {
        $id_to_update = $_POST['id_newsletter'];
        $subject_update = $_POST['subject_update'];
        $corps_message_update = $_POST['corps_message_update'];
    
        // Récupérer le titre et le corps avant l'update
        $req8 = $bdd->prepare("SELECT titre, corps FROM contenu WHERE id_bloc = :id_bloc");
        $req8->bindParam(':id_bloc', $id_to_update);
        $req8->execute();
        $recup_before_update = $req8->fetch(PDO::FETCH_ASSOC); // Utilisez fetch() au lieu de fetchAll() pour récupérer une seule ligne
    
        // Mettre à jour la table contenu
        $req6 = $bdd->prepare("UPDATE contenu SET titre = :subject_update, corps = :corps_message_update WHERE id_bloc = :id_bloc");
        $req6->bindParam(':subject_update', $subject_update);
        $req6->bindParam(':corps_message_update', $corps_message_update);
        $req6->bindParam(':id_bloc', $id_to_update);
        $req6->execute();
    
        // Insérer dans administration_contenu
        $req5 = $bdd->prepare("INSERT INTO administration_contenu(
                id_user, id_bloc, date_maj, before_maj_titre, before_maj_corps, after_maj_titre, after_maj_corps
            ) VALUES(
                :id_user, :id_bloc, NOW(), :before_maj_titre, :before_maj_corps, :after_maj_titre, :after_maj_corps
            )
        ");
        // Avant mise à jour
        $req5->bindParam(':before_maj_titre', $recup_before_update['titre']);
        $req5->bindParam(':before_maj_corps', $recup_before_update['corps']);
        // Après mise à jour
        $req5->bindParam(':after_maj_titre', $subject_update);
        $req5->bindParam(':after_maj_corps', $corps_message_update);
        $req5->bindParam(':id_user', $_SESSION['id_user']);
        $req5->bindParam(':id_bloc', $id_to_update);
        $req5->execute();
    }
    
    /*UPDATE administration_contenu
SET last_titre = 'test2'
WHERE id_maj = (
    SELECT MAX(id_maj)
    FROM administration_contenu
    WHERE id_bloc = 137
)
AND id_bloc = 137;
*/


    // Envoyer l'historique de la newsletter
    if (isset($_POST['envoyer_hist'])) {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'annuelprojet2@gmail.com';
            $mail->Password = 'zwcsygpubwzvaysr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->setFrom('annuelprojet2@gmail.com');
            
            // Récupérer les abonnés
            $req1_emails = $bdd->prepare("SELECT mail FROM utilisateur WHERE statut_newsletter = '1'");
            $req1_emails->execute();
            $emails = $req1_emails->fetchAll(PDO::FETCH_COLUMN);
            
            // Configuration de l'e-mail en dehors de la boucle
            $mail->isHTML(true);
            $mail->Subject = $_POST["subject_hist"];
            $mail->Body = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .content { padding: 20px; }
                    .header { background-color: #fcdfa5; color: white; padding: 3px; text-align: center; }
                    .footer { background-color: #fcdfa5; padding: 3px; text-align: center; font-size: 12px; }
                    .body-content { margin: 20px 0; }
                    .footer img { vertical-align: middle; margin-left: 10px; }
                </style>
            </head>
            <body>
                <div class='content'>
                    <div class='header'>
                        <h1>{$_POST['subject_hist']}</h1>
                    </div>
                    <div class='body-content'>
                        " . nl2br(htmlspecialchars($_POST['corps_message_hist'])) . "
                    </div>
                    <div class='footer'>
                        &copy; " . date('Y') . " IDK. Tous droits réservés.
                    </div>
                </div>
            </body>
            </html>";

            
            // Ajouter les destinataires
            foreach ($emails as $email) {
                $mail->addAddress($email);
            }

            // Envoyer l'e-mail
            if ($mail->send()) {
                echo "Le message a été envoyé avec succès";
            } else {
                echo "Erreur lors de l'envoi du message : " . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi du message : " . $mail->ErrorInfo;
        }
    }
    
    // Envoyer la newsletter
    if (isset($_POST['envoyer'])) {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'annuelprojet2@gmail.com';
            $mail->Password = 'zwcsygpubwzvaysr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->setFrom('annuelprojet2@gmail.com');
            
            // Récupérer les abonnés
            $req1_emails = $bdd->prepare("SELECT mail FROM utilisateur WHERE statut_newsletter = '1'");
            $req1_emails->execute();
            $emails = $req1_emails->fetchAll(PDO::FETCH_COLUMN);
            
            // Configuration de l'e-mail en dehors de la boucle
            $mail->isHTML(true);
            $mail->Subject = $_POST["subject"];
            $mail->Body = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .content { padding: 20px; }
                    .header { background-color: #007bff; color: white; padding: 10px; text-align: center; }
                    .footer { background-color: #f4f4f4; padding: 10px; text-align: center; font-size: 12px; }
                    .body-content { margin: 20px 0; }
                    .footer img { vertical-align: middle; margin-left: 10px; }
                </style>
            </head>
            <body>
                <div class='content'>
                    <div class='header'>
                        <h1>{$_POST['subject']}</h1>
                    </div>
                    <div class='body-content'>
                        " . nl2br(htmlspecialchars($_POST['corps_message'])) . "
                    </div>
                    <div class='footer'>
                        &copy; " . date('Y') . " IDK. Tous droits réservés.
                        <img src='../img/logo.svg' alt='Logo' width='50' height='50'>
                    </div>
                </div>
            </body>
            </html>";

            
            // Ajouter les destinataires
            foreach ($emails as $email) {
                $mail->addAddress($email);
            }
    
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi du message : " . $mail->ErrorInfo;
        }

        try {
            // Enregistrer dans la base de données si l'envoi est réussi
            if ($mail->send()) {
                $req2_news = $bdd->prepare("INSERT INTO contenu(page_appartenance, titre, corps, last_titre, last_corps) VALUES ('newsletter', :sujet, :corps, :last_titre, :last_corps)");
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
