<?php
    $id_user = $_SESSION['id_user'];
    $req = $bdd->prepare("SELECT id, id_user,id_admin, mail, date_message, titre, messages, statut_ticket FROM demande_admin WHERE statut = 1 AND id_user=:id_user");
    $req->bindParam(':id_user', $id_user);
    $req->execute();  
    $recup_my_tickets= $req->fetchAll(PDO::FETCH_ASSOC);

?>