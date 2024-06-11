<?php 

require_once('../../inc/php/function_search_user.php');

if (isset($_GET['keyword_user'])) {
    $keyword_user = $_GET['keyword_user'];
    require_once("db.php");

    $smtp_user = $bdd->prepare("SELECT id_user, nom, prenom, pseudo FROM utilisateur WHERE pseudo LIKE :keyword_user");
    $smtp_user->execute(array(":keyword_user" => '%' . $keyword_user . '%'));
    $res_search_user = $smtp_user->fetchAll(PDO::FETCH_ASSOC);

    $final_results = [];
    foreach ($res_search_user as $user) {
        if ($user['id_user'] !== $_SESSION['id_user']) {
            $is_friend = is_friend_already($_SESSION['id_user'], $user['id_user'], $bdd);
            $request_sent = check_friend_request_status($_SESSION['id_user'], $user['id_user'], $bdd);

            $user['is_friend'] = $is_friend;
            $user['request_sent'] = $request_sent;

            $final_results[] = $user;
        }
    }

    echo json_encode($final_results);
} else {
    echo json_encode(array("message" => "Aucun résultat trouvé"));
}
?>