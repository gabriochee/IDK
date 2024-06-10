<?php
$serverAddress = "152.228.217.19";
$username = "distant";
$password = "LEG2024IDKdistant!";

try {
    $bdd = new PDO("mysql:host=$serverAddress;dbname=IDK;port=3306", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage(); 
}

global $bdd;

?>