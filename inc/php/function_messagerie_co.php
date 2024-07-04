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

            $req2 = $bdd->prepare("INSERT INTO demande_admin(id_user, mail, date_message, titre, messages, statut) VALUES(:id_user, :mail, NOW(), :titre, :messages, 1)");
            $req2->bindParam(':id_user', $id_user);
            $req2->bindParam(':mail', $recup_mail['mail']);
            $req2->bindParam(':titre', $titre);
            $req2->bindParam(':messages', $message);
            $req2->execute();

            $id_demande = $bdd->lastInsertId();

            $req5 =$bdd->prepare("INSERT INTO message_demande(id_user, date_message, titre_demande, message_demande, id_demande) VALUES(:id_user, NOW(), :titre, :messages, :id_demande)");
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
    $req3 = $bdd->prepare("SELECT id, id_user, mail, date_message, titre, messages FROM demande_admin where statut = 1");
    $req3->execute();  
    $recup_messages_co = $req3->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST ['Statuer_co'])){
        $id_user = $_SESSION['id_user'];

        $req4 = $bdd->prepare("update demande_admin set id_admin = :id_user ");
        $req4->bindParam(':id_user', $id_user);
        $req4->execute();  
        $recup_admin = $req4->fetch();
    }
    
?>
