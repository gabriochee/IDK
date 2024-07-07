<?php
session_start();
require_once('db.php');

try {
    $id_user = $_SESSION['id_user'];
    
    $req1 = $bdd->prepare("SELECT utilisateur.id_user
        FROM ami
        INNER JOIN utilisateur ON (ami.id_user_1 = utilisateur.id_user OR ami.id_user_2 = utilisateur.id_user)
        WHERE (ami.id_user_1 = :id_user OR ami.id_user_2 = :id_user)
        AND utilisateur.id_user <> :id_user
    ");
    $req1->bindParam(":id_user", $id_user);
    $req1->execute();
    $recup_ami = $req1->fetchAll(PDO::FETCH_COLUMN, 0);

    $recup_ami[] = $id_user;

    $placeholders = implode(',', array_fill(0, count($recup_ami), '?'));

    $data = json_decode(file_get_contents('php://input'), true);
    $note1 = $data['note1'];
    $note2 = $data['note2'];
    $idMovie = $data['idMovie2'];

    $req2 = $bdd->prepare("SELECT a.critique, a.date_avis, a.statut, ceil(a.note/2) AS note, u.id_user, u.pseudo
        FROM avis AS a
        JOIN utilisateur AS u ON a.id_user = u.id_user
        WHERE (a.statut = 'publique' OR a.statut = 'amis seulement')
        AND (a.note = ? OR a.note = ?)
        AND a.id_work = ?
        AND u.id_user IN ($placeholders)
    ");

    $params = array_merge([$note1, $note2, $idMovie], $recup_ami);
    $req2->execute($params);

    $reviews = $req2->fetchAll(PDO::FETCH_ASSOC);

    $response = [
        "status" => "success",
        "reviews" => $reviews
    ];

    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
