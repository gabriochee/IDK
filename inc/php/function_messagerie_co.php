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
        } else {
            echo "Erreur : Impossible de récupérer l'email de l'utilisateur.";
        }
    }
    $req3 = $bdd->prepare("SELECT id, id_user, mail, date_message, titre, messages FROM demande_admin where statut = 1");
    $req3->execute();  
    $recup_messages_co = $req3->fetchAll(PDO::FETCH_ASSOC);

    
?>
