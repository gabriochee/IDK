<?php

try {
    $req_nb_oeuvre = $bdd->prepare("SELECT COUNT(id_work) AS nb_oeuvre FROM work_basics;");
    $req_nb_oeuvre->execute();
    $res_nb_oeuvre = $req_nb_oeuvre->fetch();

    $req_moyenne_age = $bdd->prepare("SELECT FLOOR(AVG(TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()))) AS moyenne_age FROM utilisateur;");
    $req_moyenne_age->execute();
    $res_moyenne_age = $req_moyenne_age->fetch();

    $req_genre = $bdd->prepare("SELECT DISTINCT (SELECT COUNT(sexe) FROM utilisateur WHERE sexe = 'Homme') AS hommes, (SELECT COUNT(sexe) FROM utilisateur WHERE sexe = 'Femme') AS femmes, (SELECT COUNT(sexe) FROM utilisateur WHERE sexe = 'Autre') AS autres FROM utilisateur;");
    $req_genre->execute();
    $res_genre = $req_genre->fetch();

    $req_nb_inscription = $bdd->prepare("SELECT DISTINCT COUNT(date_inscription) AS total, (SELECT COUNT(date_inscription) FROM utilisateur WHERE YEAR(date_inscription) = YEAR(CURDATE())) AS annee, (SELECT COUNT(date_inscription) FROM utilisateur WHERE YEAR(date_inscription) = YEAR(CURDATE()) AND MONTH(date_inscription) = MONTH(CURDATE())) AS mois, (SELECT COUNT(date_inscription) FROM utilisateur WHERE YEARWEEK(date_inscription, 1) = YEARWEEK(CURDATE(), 1)) AS semaine, (SELECT COUNT(date_inscription) FROM utilisateur WHERE DATE(date_inscription) = CURDATE()) AS today FROM utilisateur;");
    $req_nb_inscription->execute();
    $res_nb_inscription = $req_nb_inscription->fetch();

    $req_creation_listes = $bdd->prepare("SELECT DISTINCT COUNT(date_creation) AS total, (SELECT COUNT(date_creation) FROM listes WHERE YEAR(date_creation) = YEAR(CURDATE())) AS annee, (SELECT COUNT(date_creation) FROM listes WHERE YEAR(date_creation) = YEAR(CURDATE()) AND MONTH(date_creation) = MONTH(CURDATE())) AS mois, (SELECT COUNT(date_creation) FROM listes WHERE YEARWEEK(date_creation, 1) = YEARWEEK(CURDATE(), 1)) AS semaine, (SELECT COUNT(date_creation) FROM listes WHERE DATE(date_creation) = CURDATE()) AS today FROM listes;");
    $req_creation_listes->execute();
    $res_creation_listes = $req_creation_listes->fetch();
// pas good
    $req_moyenne_listes = $bdd->prepare("SELECT (SELECT COUNT(id_liste)) AS moyenne_liste FROM listes;");
    $req_moyenne_listes->execute();
    $res_moyenne_listes = $req_moyenne_listes->fetch();

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>