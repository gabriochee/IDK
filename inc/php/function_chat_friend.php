<?php
require("db.php");

try {
    $req1 = $bdd->prepare("
        SELECT pseudo, nom, prenom, id_user 
        FROM utilisateur 
        INNER JOIN ami 
        ON (utilisateur.id_user = ami.id_user_1 AND ami.id_user_2 = :me) 
        OR (utilisateur.id_user = ami.id_user_2 AND ami.id_user_1 = :me) 
        WHERE utilisateur.id_user != :me
    ");
    $req1->execute(['me' => $_SESSION['id_user']]);
    $rep1 = $req1->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($rep1);
    echo "<script>let friendData = $json;</script>";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}


try {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['myText']) && isset($data['friendId'])) {
        $myText = $data['myText'];
        $friendId = $data['friendId'];
        
        $sql = "INSERT INTO messages (id_user_1, id_user_2, contenu_message, date_message) VALUES (:id_user_1, :id_user_2, :contentMessage, NOW())";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_user_1', $_SESSION['id_user']);
        $stmt->bindParam(':id_user_2', $friendId);
        $stmt->bindParam(':contentMessage', $myText);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Erreur lors de l'insertion des données"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Données invalides"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>