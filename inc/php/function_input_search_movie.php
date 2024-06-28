<?php 

$keyword_movie = $_GET['keyword_movie'];

require_once("db.php");

$smtp_movie = $bdd->prepare("SELECT work_akas.id_work, work_akas.title, work_ratings.numVotes FROM work_akas JOIN work_ratings ON work_akas.id_work = work_ratings.id_work WHERE MATCH (title) AGAINST (:keyword_movie IN NATURAL LANGUAGE MODE) GROUP BY (work_akas.id_work) ORDER BY work_ratings.numVotes DESC LIMIT 20;");

try {
    $smtp_movie->bindValue(":keyword_movie", "'\"" . $keyword_movie . "'\"");
    $smtp_movie->execute();
    $res_search_movie = $smtp_movie->fetchAll();
} catch (PDOException $e) {
    echo json_encode(array("message" => $e->getMessage()));
    exit;
}

if ($res_search_movie) {
    echo json_encode($res_search_movie);
    exit;
} else {
    echo json_encode(array("message" => "Aucun résultat trouvé pour " . $keyword_movie));
    exit;
}

?>