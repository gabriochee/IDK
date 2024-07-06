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

    $req_moyenne_listes = $bdd->prepare("SELECT AVG(liste_count) AS moyenne_liste FROM (SELECT u.id_user, COUNT(l.id_liste) AS liste_count FROM utilisateur u LEFT JOIN listes l ON u.id_user = l.id_user AND l.statut != 'default' GROUP BY u.id_user) AS subquery;");
    $req_moyenne_listes->execute();
    $res_moyenne_listes = $req_moyenne_listes->fetch();

    $req_nb_questionnaire = $bdd->prepare("SELECT COUNT(DISTINCT id_questionnaire) as total, (SELECT COUNT(DISTINCT id_questionnaire) FROM reponses_questionnaire WHERE YEAR(date) = YEAR(CURDATE())) AS annee, (SELECT COUNT(DISTINCT id_questionnaire) FROM reponses_questionnaire WHERE YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE())) AS mois, (SELECT COUNT(DISTINCT id_questionnaire) FROM reponses_questionnaire WHERE YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1)) AS semaine, (SELECT COUNT(DISTINCT id_questionnaire) FROM reponses_questionnaire WHERE DATE(date) = CURDATE()) AS today FROM reponses_questionnaire;");
    $req_nb_questionnaire->execute();
    $res_nb_questionnaire = $req_nb_questionnaire->fetch();

    $req_questionnaire_origine = $bdd->prepare("SELECT corps_reponse FROM IDK.reponses_questionnaire WHERE corps_question = 'De quel pays d\'origine préféreriez-vous ?' ORDER BY corps_reponse DESC LIMIT 5;");
    $req_questionnaire_origine->execute();
    $res_questionnaire_origine = $req_questionnaire_origine->fetch();

    $req_questionnaire_annee = $bdd->prepare("SELECT corps_reponse FROM IDK.reponses_questionnaire WHERE corps_question = 'De quelle année ?' ORDER BY corps_reponse DESC LIMIT 5;");
    $req_questionnaire_annee->execute();
    $res_questionnaire_annee = $req_questionnaire_annee->fetch();

    function getTopGenres($bdd, $interval) {
        $query = "SELECT corps_reponse FROM reponses_questionnaire WHERE corps_question = 'Quel genre vous attire ? (3 maximum)' AND $interval";
        
        $stmt = $bdd->prepare($query);
        $stmt->execute();
        $responses = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        $genreCounts = [];
        foreach ($responses as $response) {
            $genres = explode('/', $response);
            foreach ($genres as $genre) {
                $genre = trim($genre);
                if (!empty($genre)) {
                    if (!isset($genreCounts[$genre])) {
                        $genreCounts[$genre] = 0;
                    }
                    $genreCounts[$genre]++;
                }
            }
        }
        
        arsort($genreCounts);
        return array_slice($genreCounts, 0, 5, true);
    }

    $today = getTopGenres($bdd, "DATE(date) = CURDATE()");
    $thisWeek = getTopGenres($bdd, "YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1)");
    $thisMonth = getTopGenres($bdd, "YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE())");
    $thisYear = getTopGenres($bdd, "YEAR(date) = YEAR(CURDATE())");
    $total = getTopGenres($bdd, "1=1");


} catch (PDOException $e) {
    echo $e->getMessage();
}

?>