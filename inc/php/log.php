<?php
require_once('db.php');

function server_log($action, $ip){
    global $bdd;

    $request = $bdd->prepare('INSERT INTO log(date_log, log_action, adresse_ip) VALUES (:date_log, :log_action, :adresse_ip);');
    $request->bindValue(':date_log', date("Y-m-d H-m-s"));
    $request->bindParam(':log_action', $action);
    $request->bindParam(':adresse_ip', $ip);
}