<?php
require('db.php');
date_default_timezone_set('Europe/Paris');

function server_log($action){
    global $bdd;

    try {
        $request = $bdd->prepare('INSERT INTO logs(date_log, log_action, adresse_ip) VALUES (:date_log, :log_action, :adresse_ip);');
        $request->bindValue(':date_log', date("Y-m-d H:i:s"));
        $request->bindParam(':log_action', $action);
        $request->bindParam(':adresse_ip', $_SERVER['REMOTE_ADDR']);
        $request->execute();
    } catch (PDOException $e){
        echo $e->getMessage();
    }
}