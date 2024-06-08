<?php 

$keyword_movie = $_GET['keyword_movie'];

require("db.php");

$smtp_movie = $bdd->prepare("SELECT id_work, title FROM work_akas WHERE MATCH (title) AGAINST (:keyword_movie IN NATURAL LANGUAGE MODE) GROUP BY (title) LIMIT 20;");

try {
    $smtp_movie->bindValue(":keyword_movie", "'\"+" . $keyword_movie . "'\"");
    $smtp_movie->execute();
    $res_search_movie = $smtp_movie->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e){
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