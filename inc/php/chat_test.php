<?php
    require("db.php");

    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['myTextField'])) {
        $myTextField = $data['myTextField'];
        
        if ($conn->connect_error) {
        die(json_encode(["status" => "error", "message" => "Connexion échouée: " . $conn->connect_error]));
    }

    $sql ="INSERT INTO messages (id_user_1, id_user_2,contenu_message) VALUES (2,3:contentMessage)";
    $stmt = $bdd->prepare($sql);
    $stmt->bind_param("contentMessage", $myTextField);
    $stmt->execute();
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Donnees insérées avec succes"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erreur lors de l'insertion des donnees: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Donnees invalides"]);
    }

?>