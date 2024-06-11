<?php
// Informations de connexion à la base de données
require_once('../../inc/php/db.php');

try {
    // Connexion à la base de données
    

    // Lire les données JSON envoyées dans le corps de la requête
    $data = json_decode(file_get_contents('php://input'), true);

    // Vérifier que les données contiennent le champ "message"
    if (isset($data['message'])) {
        $message = $data['message'];

        // Préparer et exécuter la requête d'insertion
        $stmt = $bdd->prepare("INSERT INTO test (contenu_message) VALUES (:message)");
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            // Répondre avec un statut de succès
            echo json_encode(["status" => "success"]);
        } else {
            // Répondre avec un statut d'erreur
            echo json_encode(["status" => "error"]);
        }
    } else {
        // Répondre avec un statut d'erreur si le champ "message" est absent
        echo json_encode(["status" => "error", "message" => "Champ message absent"]);
    }
} catch (PDOException $e) {
    // Répondre avec un statut d'erreur en cas d'exception
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
