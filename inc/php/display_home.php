<?php 
require_once('db.php');

$cette_annee = date('Y');
$data_nouveaute = $bdd->prepare("SELECT id_work, primaryTitle, startYear, genre FROM (SELECT wb.id_work, wb.primaryTitle, wb.startYear, wg.genre FROM work_basics wb JOIN work_genres wg ON wb.id_work = wg.id_work WHERE startYear = $cette_annee ORDER BY wb.id_work DESC LIMIT 100) AS subquery ORDER BY RAND() LIMIT 3;");
$data_nouveaute->execute();

$data_populaires = $bdd->prepare("SELECT work_ratings.id_work, primaryTitle, startYear, genre FROM work_basics JOIN work_ratings ON work_ratings.id_work = work_basics.id_work JOIN work_genres ON work_basics.id_work = work_genres.id_work WHERE startYear = $cette_annee GROUP BY work_basics.id_work ORDER BY work_ratings.numVotes DESC LIMIT 100;");
$data_populaires->execute();

$res_nouveaute = $data_nouveaute->fetchAll();
$res_populaires = $data_populaires->fetchAll();
var_dump($res_populaires);
?>
