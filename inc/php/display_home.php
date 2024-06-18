<?php 
$data_nouveaute = $bdd->prepare("
    SELECT id_work, primaryTitle, startYear, genre 
    FROM (
        SELECT wb.id_work, wb.primaryTitle, wb.startYear, wg.genre 
        FROM work_basics wb 
        JOIN work_genres wg ON wb.id_work = wg.id_work 
        ORDER BY wb.id_work DESC 
        LIMIT 100
    ) AS subquery 
    ORDER BY RAND() 
    LIMIT 3;
");
$data_nouveaute->execute();
$res_nouveaute = $data_nouveaute->fetchAll();
?>
