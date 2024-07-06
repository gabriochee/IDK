<?php
    require('db.php');
    if(isset($_GET['id_demande'])) {

        $req = $bdd->prepare("SELECT 
        message_demande.id_user, 
        message_demande.id_admin, 
        message_demande.titre_demande, 
        message_demande.message_demande, 
        message_demande.message, 
        message_demande.date_message, 
        message_demande.id_demande, 
        message_demande.statut_ticket, 
        utilisateur.pseudo
        FROM 
            message_demande
        LEFT JOIN 
            utilisateur ON message_demande.id_user = utilisateur.id_user
        WHERE 
            message_demande.id_demande = :id_demande");

        $req->bindParam(":id_demande", $_GET['id_demande']);
        $req->execute();

        $recup_ticket= $req->fetch();

        $req3 = $bdd->prepare("SELECT message,date_message,envoyeur,receveur,etre_admin FROM message_demande WHERE id_demande = :id_demande AND etre_message =1");

        $req3->bindParam(":id_demande", $_GET['id_demande']);
        $req3->execute();
        $recup_message = $req3->fetchAll();

    }

    
    
    if (isset($_GET['corps_message']) && isset($_GET['id_demande'])) {
        $req = $bdd->prepare("SELECT 
        message_demande.id_user, 
        message_demande.id_admin, 
        message_demande.titre_demande, 
        message_demande.message_demande, 
        message_demande.message, 
        message_demande.date_message, 
        message_demande.id_demande, 
        message_demande.statut_ticket, 
        utilisateur.pseudo
        FROM 
            message_demande
        LEFT JOIN 
            utilisateur ON message_demande.id_user = utilisateur.id_user
        WHERE 
            message_demande.id_demande = :id_demande");

        $req->bindParam(":id_demande", $_GET['id_demande']);
        $req->execute();

        $recup_ticket2= $req->fetch();
        if ($recup_ticket2) {
            $id_user = $recup_ticket2['id_user'];
            $id_admin = $recup_ticket2['id_admin'];
            $messages = $_GET['corps_message']; 
            $id_demande = $_GET['id_demande'];
            $statut_ticket = $recup_ticket2['statut_ticket'];
            $envoyeur = $_SESSION['id_user'];
            $receveur = $recup_ticket2['id_user'];

            $send_demande = $bdd->prepare("INSERT INTO message_demande(id_user, id_admin, message, date_message, id_demande, statut_ticket,envoyeur,receveur,etre_message,etre_admin) VALUES(:id_user, :id_admin, :message, NOW(), :id_demande, :statut_ticket,:envoyeur,:receveur,1,1)");
            $send_demande->bindParam(":id_user", $id_user);
            $send_demande->bindParam(":id_admin", $id_admin);
            $send_demande->bindParam(":message", $messages);
            $send_demande->bindParam(":id_demande", $id_demande);
            $send_demande->bindParam(":statut_ticket", $statut_ticket);
            $send_demande->bindParam(":envoyeur", $envoyeur);
            $send_demande->bindParam(":receveur", $receveur);
            $send_demande->execute();
            header("Location: demande_message.php?id_demande=$id_demande");
        }
    }

    
?>