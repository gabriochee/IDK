<?php
session_start();
require_once('db.php');

<<<<<<< HEAD
try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['message'])) {
        $message = $data['message'];
        $idFriend = $data['idFriend'];
        $me = $_SESSION['id_user'];
=======
        $data = json_decode(file_get_contents('php://input'), true);
>>>>>>> 7c277aad49c2ca106105b840e3332dcada45a4d0

        $stmt = $bdd->prepare("INSERT INTO messages (contenu_message, id_user_1, id_user_2, date_messsage) VALUES (:message, :me, :idFriend, NOW())");
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':idFriend', $idFriend);
        $stmt->bindParam(':me', $me);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Champ message absent"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
