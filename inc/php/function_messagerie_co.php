<?php
    require('db.php');
    if (isset($_POST['submit'])) {
        $id_user = $_SESSION['id_user'];

        $req1 = $bdd->prepare("SELECT mail FROM utilisateur WHERE id_user = :id_user");
        $req1->bindParam(':id_user', $id_user);
        $req1->execute();  
        $recup_mail = $req1->fetch(PDO::FETCH_ASSOC);
        if ($recup_mail) {
            $titre = $_POST['titre'];
            $message = $_POST['message'];

            $req2 = $bdd->prepare("INSERT INTO demande_admin(id_user, mail, date_message, titre, messages, statut, statut_ticket) VALUES(:id_user, :mail, NOW(), :titre, :messages, 1,'Pas commence')");
            $req2->bindParam(':id_user', $id_user);
            $req2->bindParam(':mail', $recup_mail['mail']);
            $req2->bindParam(':titre', $titre);
            $req2->bindParam(':messages', $message);
            $req2->execute();

            $id_demande = $bdd->lastInsertId();

            $req5 =$bdd->prepare("INSERT INTO message_demande(id_user, date_message, titre_demande, message_demande, id_demande,etre_message, statut_ticket,etre_admin) VALUES(:id_user, NOW(), :titre, :messages, :id_demande, 0,'Pas commence',0)");
            $req5->bindParam(':id_user', $id_user);
            $req5->bindParam(':id_demande', $id_demande);
            $req5->bindParam(':titre', $titre);
            $req5->bindParam(':messages', $message);
            $req5->execute();
            echo "<div class='alert alert-success text-center' role='alert'>Votre message a bien été envoyé, vous recevrez un retour d'ici 24h.</div>";
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>Erreur : Impossible de récupérer l'email de l'utilisateur.</div>";
        }
    }
    $req3 = $bdd->prepare("SELECT id, id_user,id_admin, mail, date_message, titre, messages, statut_ticket FROM demande_admin where statut = 1");
    $req3->execute();  
    $recup_messages_co = $req3->fetchAll(PDO::FETCH_ASSOC);


    if (isset($_POST['Statuer_co'])) {
        $id_demande = $_POST['id_demande'];
    
        $ticket_status = $_POST['ticket_status'];
    
        $id_user = $_SESSION['id_user'];
    
        $req4 = $bdd->prepare("UPDATE demande_admin SET id_admin = :id_user, statut_ticket = :ticket_status WHERE id = :id_demande");
        $req4->bindParam(':id_user', $id_user);
        $req4->bindParam(':ticket_status', $ticket_status);
        $req4->bindParam(':id_demande', $id_demande);
        $req4->execute();

        $req6 = $bdd->prepare("UPDATE message_demande SET id_admin = :id_user, statut_ticket = :ticket_status WHERE id_demande = :id_demande");
        $req6->bindParam(':id_user', $id_user);
        $req6->bindParam(':ticket_status', $ticket_status);
        $req6->bindParam(':id_demande', $id_demande);
        $req6->execute();

        header('Location: messagerie_adm.php');
    }
    
    
    
    
?>
