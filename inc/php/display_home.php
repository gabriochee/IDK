<?php
require_once('db.php');

try {
    $cette_annee = date('Y');
    $data_nouveaute = $bdd->prepare("SELECT id_work, primaryTitle, startYear, genre, name FROM (SELECT wb.id_work, wb.primaryTitle, wb.startYear, wg.genre, name_basics.name FROM work_basics wb JOIN work_genres wg ON wb.id_work = wg.id_work JOIN work_director ON wb.id_work = work_director.id_work JOIN name_basics ON work_director.id_person = name_basics.id_person WHERE startYear = :annee ORDER BY wb.id_work DESC LIMIT 100) AS subquery ORDER BY RAND() LIMIT 3;");
    $data_nouveaute->bindParam(':annee', $cette_annee);
    $data_nouveaute->execute();

    $data_populaires = $bdd->prepare("SELECT id_work, primaryTitle, startYear, genre, name FROM (SELECT work_ratings.id_work, primaryTitle, startYear, genre, name_basics.name FROM work_basics JOIN work_ratings ON work_ratings.id_work = work_basics.id_work JOIN work_genres ON work_basics.id_work = work_genres.id_work JOIN work_director ON work_basics.id_work = work_director.id_work JOIN name_basics ON work_director.id_person = name_basics.id_person WHERE startYear = :annee AND work_ratings.averageRating >= 7.0 GROUP BY work_basics.id_work ORDER BY work_ratings.numVotes DESC LIMIT 30) AS subquery ORDER BY RAND() LIMIT 3;");
    $data_populaires->bindParam(':annee', $cette_annee);
    $data_populaires->execute();

    $data_listes_populaires = $bdd->query("SELECT id_liste, listes.nom, details, pseudo FROM listes JOIN utilisateur ON listes.id_user = utilisateur.id_user WHERE statut = 'publique' ORDER BY partages DESC LIMIT 3;");

    $res_nouveaute = $data_nouveaute->fetchAll();
    $res_populaires = $data_populaires->fetchAll();
    $res_listes_populaires = $data_listes_populaires->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}
