<?php
    require('db.php');
    if (isset($_POST['submit_not_connected'])) {
        $mail = $_POST['email'];
        $titre = $_POST['titre'];
        $messages = $_POST['message'];
        $sexe = $_POST['sexe'];
        $prenom = $_POST['firstName'];
        $nom = $_POST['lastName'];
        $telephone = $_POST['number'];

        $req1 = $bdd->prepare("INSERT INTO demande_admin(mail, date_message, titre, messages, sexe, prenom, nom, telephone,statut) VALUES( :mail, NOW(), :titre, :messages, :sexe, :prenom, :nom, :telephone,0)");
        $req1->bindParam(':mail', $mail);
        $req1->bindParam(':titre', $titre);
        $req1->bindParam(':messages', $messages);
        $req1->bindParam(':sexe', $sexe);
        $req1->bindParam(':prenom', $prenom);
        $req1->bindParam(':nom', $nom);
        $req1->bindParam(':telephone', $telephone);

        $req1->execute();
        echo "<div class='alert alert-success text-center' role='alert'>Votre message a bien été envoyé, vous recevrez un retour d'ici 24h.</div>";
    }
    $req3 = $bdd->prepare("SELECT id , mail, date_message, titre, messages FROM demande_admin where statut = 0");
    $req3->execute();  
    $recup_messages_not_co = $req3->fetchAll(PDO::FETCH_ASSOC);

    

?>