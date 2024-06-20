<?php
session_start();
require_once('db.php');

try {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['note']) && isset($data['idMovie2'])) {
        $me = $_SESSION['id_user'];
        $note = $data['note'];
        $idMovie = $data['idMovie2'];

        $req2 = $bdd->prepare("SELECT a.critique, a.date_avis, a.statut, a.note, u.id_user, u.pseudo
                                FROM avis AS a
                                JOIN utilisateur AS u ON a.id_user = u.id_user
                                WHERE (a.statut = 'publique' OR a.statut = 'amis seulement')
                                AND a.note = :note
                                AND a.id_work = :id_work
                                ");
        $req2->bindParam(":note", $note);
        $req2->bindParam(":id_work", $idMovie);
        $req2->execute();

        $reviews = $req2->fetchAll(PDO::FETCH_ASSOC);


        $response = [
            "status" => "success",
            "reviews" => $reviews
        ];

        echo json_encode($response);
    }else{
        echo json_encode(["status" => "error", "message" => "La note n'est pas spécifie."]);
    }
    } catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
