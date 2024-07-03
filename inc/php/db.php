<?php
date_default_timezone_set("Europe/Paris");


$serverAddress = "152.228.217.19";
$username = "distant";
$password = "LEG2024IDKdistant!";
$option = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
if (!function_exists('handle_error')) {
    function handle_error($message) {
        error_log($message);
        header("Location: /IDK/error/error500.php");
        exit();
    }
}

try {
    $bdd = new PDO("mysql:host=$serverAddress;dbname=IDK;port=3306", $username, $password, $option);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    handle_error("Erreur : " . $e->getMessage());
}

global $bdd;

?>