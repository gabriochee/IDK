<?php
    session_start();
    require_once('db.php');
    try {

        $data = json_decode(file_get_contents('php://input'), true);
        error_log(print_r($data, true));
        if (isset($data['comment'])) {
            $idMovie = $data['idMovie'];
            $me = $_SESSION['id_user'];
            $statut = $data['statut'];
            $comment = $data['comment'];
            $note = $data['note'];
            
            
            

            $stmt = $bdd->prepare("INSERT INTO avis (id_work, id_user, statut, critique, note, date_avis) VALUES (:idMovie, :me, :statut, :comment, :note, NOW())");
            $stmt->bindParam(':idMovie', $idMovie);
            $stmt->bindParam(':me', $me);
            $stmt->bindParam(':statut', $statut);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':note', $note);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Champ commentaire absent"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
?>

