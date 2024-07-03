<?php
    session_start();
    require_once('db.php');
    try {


        $data = json_decode(file_get_contents('php://input'), true);
        $hasAvis = false;
        $hasComment = isset($data['comment']);
        $hasNote = isset($data['note']);
        
        if ($hasNote || $hasComment){
            $req = $bdd->prepare("SELECT COUNT(id_avis) FROM avis WHERE id_user = :id_user AND id_work = :id_work;");
            $req->bindParam(":id_user", $_SESSION['id_user']);
            $req->bindParam(":id_work", $data['idMovie']);
            $req->execute();

            $hasAvis = $req->fetch()['COUNT(id_avis)'];
        } else {
            exit();
        }

        if ($hasComment && !$hasAvis) {
            $idMovie = $data['idMovie'];
            $me = $_SESSION['id_user'];
            $statut = $data['statut'];
            $comment = $data['comment'];

            $stmt = $bdd->prepare("INSERT INTO avis (id_work, id_user, statut, critique, note, date_avis) VALUES (:idMovie, :me, :statut, :comment, NULL, NOW())");
            $stmt->bindParam(':idMovie', $idMovie);
            $stmt->bindParam(':me', $me);
            $stmt->bindParam(':statut', $statut);
            $stmt->bindParam(':comment', $comment);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        } else if ($hasNote && !$hasAvis) {
            $idMovie = $data['idMovie'];
            $me = $_SESSION['id_user'];
            $statut = $data['statut'];
            $note = $data['note'];

            $stmt = $bdd->prepare("INSERT INTO avis (id_work, id_user, statut, critique, note, date_avis) VALUES (:idMovie, :me, :statut, NULL, :note, NOW())");
            $stmt->bindParam(':idMovie', $idMovie);
            $stmt->bindParam(':me', $me);
            $stmt->bindParam(':statut', $statut);
            $stmt->bindParam(':note', $note);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        } else if ($hasComment && $hasAvis) {
            $idMovie = $data['idMovie'];
            $me = $_SESSION['id_user'];
            $statut = $data['statut'];
            $comment = $data['comment'];

            $stmt = $bdd->prepare("UPDATE avis SET critique = :comment, statut = :statut WHERE id_user = :me AND id_work = :idMovie");
            $stmt->bindParam(':idMovie', $idMovie);
            $stmt->bindParam(':me', $me);
            $stmt->bindParam(':statut', $statut);
            $stmt->bindParam(':comment', $comment);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        } else if ($hasNote && $hasAvis) {
            $idMovie = $data['idMovie'];
            $me = $_SESSION['id_user'];
            $note = $data['note'];

            $stmt = $bdd->prepare("UPDATE avis SET note = :note WHERE id_user = :me AND id_work = :idMovie");
            $stmt->bindParam(':idMovie', $idMovie);
            $stmt->bindParam(':me', $me);
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
