<?php 

$keyword_movie = $_GET['keyword_movie'];

require("db.php");

$smtp_movie = $bdd->prepare("SELECT id_work, primaryTitle FROM work_basics WHERE primaryTitle LIKE :keyword_movie");
$smtp_movie->execute(array(":keyword_movie" => '%'.$keyword_movie.'%'));
$res_search_movie = $smtp_movie->fetchAll(PDO::FETCH_ASSOC);

if ($res_search_movie) {
    echo json_encode($res_search_movie);
    exit;
} else {
    echo json_encode(array("message" => "Aucun résultat trouvé"));
}

?>