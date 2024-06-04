<?php
// Informations de connexion à la base de données
    session_start();
    require('db.php');
    
    try {
        
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['currentFriendId'])) {
            $idFriend = $data['currentFriendId'];

            $stmt = $bdd->prepare("SELECT date_message,contenu_message,id_user_1, id_user_2 FROM messages WHERE id_user_2 = :other");
            $stmt->bindParam(':other', $idFriend, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $friendMessage = $stmt->fetchAll(PDO::FETCH_ASSOC);
                exit(json_encode($friendMessage));
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to execute query"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid input"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
?>
