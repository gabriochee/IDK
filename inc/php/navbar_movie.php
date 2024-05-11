<?php 
        $keyword = $_GET['keyword'];

        $smtp = $bdd_imdb->prepare("SELECT * FROM work_basics WHERE primaryTitle LIKE :keyword");
        $smtp->execute(array(":keyword" => '%'.$keyword.'%'));
        $res = $smtp->fetchAll(PDO::FETCH_ASSOC);

?>