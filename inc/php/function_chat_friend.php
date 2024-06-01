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

if(isset($_POST['submit'])){
    try {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['message'])) {
            $message = $data['message'];

            $stmt = $bdd->prepare("INSERT INTO test (contenu_message) VALUES (:message)");
            $stmt->bindParam(':message', $message);

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
}
?>