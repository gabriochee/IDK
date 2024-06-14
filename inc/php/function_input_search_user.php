<?php 
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

require_once('function_search_user.php');

try {
    if (isset($_GET['keyword_user'])) {
        session_start();
        if (!isset($_SESSION['id_user'])) {
            handle_error("Utilisateur non authentifié.");
        }
        
        $keyword_user = $_GET['keyword_user'];
        require_once("db.php");

        // Configure PDO pour afficher les erreurs
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id_user = $_SESSION['id_user'];
        
        $smtp_user = $bdd->prepare("SELECT id_user, nom, prenom, pseudo FROM utilisateur WHERE pseudo LIKE :keyword_user AND id_user != :id_user");
        $smtp_user->bindValue(':keyword_user', '%' . $keyword_user . '%');
        $smtp_user->bindValue(':id_user', $id_user, PDO::PARAM_INT);


        if (!$smtp_user->execute()) {
            handle_error("Erreur lors de l'exécution de la requête SQL.");
        }

        $res_search_user = $smtp_user->fetchAll(PDO::FETCH_ASSOC);

        $final_results = [];
        foreach ($res_search_user as $user) {
            if ($user['id_user'] !== $_SESSION['id_user']) {
                $is_friend = is_friend_already($_SESSION['id_user'], $user['id_user'], $bdd);
                $request_sent = check_friend_request_status_from_me($_SESSION['id_user'], $user['id_user'], $bdd);
                $request_received = check_friend_request_status_from_other($_SESSION['id_user'], $user['id_user'], $bdd);
                $user['is_friend'] = $is_friend;
                $user['request_sent'] = $request_sent;
                $user['request_received'] = $request_received;

                $final_results[] = $user;
            }
        }

        echo json_encode($final_results);
    } else {
        echo json_encode(array("message" => "Aucun résultat trouvé"));
    }
} catch (Exception $e) {
    handle_error($e->getMessage());
}
?>
