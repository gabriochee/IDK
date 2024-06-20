<?php
$req = $bdd->prepare("SELECT id_log, date_log, log_action, adresse_ip FROM logs");
$req->execute();
$res = $req->fetchAll(PDO::FETCH_ASSOC);
?>
