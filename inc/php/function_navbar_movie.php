<?php 

$keyword = $_GET['keyword'];

$serverAddress = "152.228.217.19";
$username = "distant";
$password = "LEG2024IDKdistant!";


try {
    $bdd = new PDO("mysql:host=$serverAddress;dbname=projet;port=3306", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage(); 
}

try {
    $bdd = new PDO("mysql:host=$serverAddress;dbname=IMDb;port=3306", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage(); 
}

$smtp = $bdd->prepare("SELECT id_work, primaryTitle FROM work_basics WHERE primaryTitle LIKE :keyword");
$smtp->execute(array(":keyword" => '%'.$keyword.'%'));
$res = $smtp->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si des résultats ont été trouvés
if ($res) {
        // Envoyer les résultats au format JSON
        echo json_encode($res);
} else {
        // Aucun résultat trouvé
        echo json_encode(array("message" => "Aucun résultat trouvé"));
}
