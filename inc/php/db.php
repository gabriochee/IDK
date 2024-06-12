<?php
$serverAddress = "152.228.217.19";
$username = "distant";
$password = "LEG2024IDKdistant!";

function handle_error($message) {
    error_log($message);
    header("Location: http://localhost:8888/IDK/error/error500.php");
    exit();
}

try {
    $bdd = new PDO("mysql:host=$serverAddress;dbname=IDK;port=3306", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    handle_error("Erreur : " . $e->getMessage());
}

global $bdd;

?>