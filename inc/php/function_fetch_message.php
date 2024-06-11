<?php
// Informations de connexion à la base de données
    session_start();
    require_once('db.php');
    
    try {
        
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['currentFriendId'])) {
            $idFriend = $data['currentFriendId'];
            $idMe = $data['me'];
            $stmt = $bdd->prepare("SELECT
                messages.date_messsage,
                messages.contenu_message,
                messages.id_user_1,
                messages.id_user_2,
                CASE
                    WHEN messages.id_user_1 = :other THEN utilisateur1.pseudo
                    WHEN messages.id_user_2 = :other THEN utilisateur2.pseudo
                END AS pseudo_other
            FROM messages
            LEFT JOIN utilisateur AS utilisateur1 ON messages.id_user_1 = utilisateur1.id_user
            LEFT JOIN utilisateur AS utilisateur2 ON messages.id_user_2 = utilisateur2.id_user
            WHERE 
                (messages.id_user_1 = :other AND messages.id_user_2 = :me) OR
                (messages.id_user_2 = :other AND messages.id_user_1 = :me)");
            $stmt->bindParam(':other', $idFriend, PDO::PARAM_INT);
            $stmt->bindParam(':me', $idMe, PDO::PARAM_INT);

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
