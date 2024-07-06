<?php
session_start();
require_once('db.php');

$data = json_decode(file_get_contents('php://input'), true);
$answers = $data['answers'];
$answersQuestions = $data['answersQuestions'];
$id_user = $_SESSION['id_user'];

foreach ($answersQuestions as $i => $answersQuestion) {
    $corps_reponse = is_array($answers[$i]) ? implode('/', $answers[$i]) : $answers[$i];
    $id_questionnaire = date("Y-m-d-H:i-") . $id_user;
    $req_insert = $bdd->prepare("INSERT INTO reponses_questionnaire (date, corps_question, corps_reponse, id_user, id_questionnaire) VALUES (NOW(), :corps_question, :corps_reponse, :id_user, :id_questionnaire)");
    $req_insert->bindParam(':corps_question', $answersQuestion);
    $req_insert->bindParam(':corps_reponse', $corps_reponse);
    $req_insert->bindParam(':id_user', $id_user);
    $req_insert->bindParam(':id_questionnaire', $id_questionnaire);
    $req_insert->execute();
}

$liste_dejavu = $bdd->prepare("SELECT id_work FROM element_liste JOIN listes ON element_liste.id_liste = listes.id_liste WHERE listes.id_user = :id_user AND nom = 'Déjà vu';");
$liste_dejavu->execute(array("id_user" => $id_user));
$res_liste_dejavu = $liste_dejavu->fetchAll();
$data_user = $bdd->prepare("SELECT moyenne_age_ami, majorite_genre_ami FROM utilisateur WHERE id_user = :id_user;");
$data_user->execute(array("id_user" => $id_user));
$res_data_user = $data_user->fetch();
$moyenne_age_ami = isset($res_data_user['moyenne_age_ami']) ? $res_data_user['moyenne_age_ami'] : '';
$majorite_genre_ami = isset($res_data_user['majorite_genre_ami']) ? $res_data_user['majorite_genre_ami'] : '';
$avis = isset($answers[0]) ? $answers[0] : '';
$bande_son = isset($answers[1]) ? $answers[1] : '';
$effet_speciaux = isset($answers[2]) ? $answers[2] : '';
$casting = isset($answers[3]) ? $answers[3] : '';
$duree = isset($answers[4]) ? $answers[4] : '';
$provenance = isset($answers[5]) ? $answers[5] : '';
$genres = isset($answers[6]) ? $answers[6] : [];
$annee = isset($answers[7]) ? $answers[7] : '';
$avoir = isset($answers[8]) ? $answers[8] : '';

$asie = ['AF', 'AM', 'AZ', 'BH', 'BD', 'BT', 'BN', 'KH', 'CN', 'GE', 'IN', 'ID', 'IR', 'IQ', 'IL', 'JP', 'JO', 'KZ', 'KW', 'KG', 'LA', 'LB', 'MY', 'MV', 'MN', 'MM', 'NP', 'KP', 'KR', 'OM', 'PK', 'PS', 'PH', 'QA', 'SA', 'SG', 'LK', 'SY', 'TW', 'TJ', 'TH', 'TL', 'TR', 'TM', 'AE', 'UZ', 'VN', 'YE'];
$afrique = ['DZ', 'AO', 'BJ', 'BW', 'BF', 'BI', 'CM', 'CV', 'CF', 'TD', 'KM', 'CG', 'CD', 'CI', 'DJ', 'EG', 'GQ', 'ER', 'ET', 'GA', 'GM', 'GH', 'GN', 'GW', 'KE', 'LS', 'LR', 'LY', 'MG', 'MW', 'ML', 'MR', 'MU', 'YT', 'MA', 'MZ', 'NA', 'NE', 'NG', 'RE', 'RW', 'ST', 'SN', 'SC', 'SL', 'SO', 'ZA', 'SS', 'SD', 'SZ', 'TZ', 'TG', 'TN', 'UG', 'EH', 'ZM', 'ZW'];
$europe = ['AL', 'AD', 'AM', 'AT', 'AZ', 'BY', 'BE', 'BA', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'GE', 'DE', 'GR', 'HU', 'IS', 'IE', 'IT', 'KZ', 'XK', 'LV', 'LI', 'LT', 'LU', 'MT', 'MD', 'MC', 'ME', 'NL', 'MK', 'NO', 'PL', 'PT', 'RO', 'RU', 'SM', 'RS', 'SK', 'SI', 'ES', 'SE', 'CH', 'TR', 'UA', 'GB', 'VA'];
$amerique = ['AS', 'AI', 'AG', 'AR', 'AW', 'BS', 'BB', 'BZ', 'BM', 'BO', 'BR', 'VG', 'CL', 'CO', 'CR', 'CU', 'DM', 'DO', 'EC', 'SV', 'FK', 'GF', 'GL', 'GD', 'GP', 'GT', 'GY', 'HT', 'HN', 'JM', 'MQ', 'MX', 'MS', 'AN', 'NI', 'PA', 'PY', 'PE', 'PR', 'BL', 'KN', 'LC', 'MF', 'PM', 'VC', 'SR', 'TT', 'TC', 'VI', 'UY', 'VE'];
$country = ['Etats-Unis' => 'US', 'Inde' => 'IN', 'Chine' => 'CN', 'Japon' => 'JP', 'Angleterre' => 'GB', 'Allemagne' => 'DE', 'France' => 'FR', 'Corée du Sud' => 'KR', 'Brésil' => 'BR', 'Nigéria' => 'NG', 'Italie' => 'IT'];
$annee_actuel = date("Y");
$query = "SELECT 
DISTINCT wb.id_work, primaryTitle 
FROM work_basics wb 
JOIN work_ratings wr ON wb.id_work = wr.id_work 
JOIN work_akas wa ON wb.id_work = wa.id_work 
JOIN work_genres wg ON wb.id_work = wg.id_work 
JOIN work_principals wp ON wb.id_work = wp.id_work 
JOIN name_basics nb ON wp.id_person = nb.id_person 
JOIN name_professions np ON wp.id_person = np.id_person 
WHERE 1=1";

if ($avis) {
    if ($avis == 'Toujours') {
        $query .= " AND wr.averageRating > 8.5";
    } else if ($avis == 'De temps en temps') {
        $query .= " AND wr.averageRating > 7.5";
    }
}

if ($bande_son) {
    if ($bande_son == "Oui !!") {
        $query .= " AND wp.category = 'composer' AND nb.id_person IN (SELECT id_person FROM name_professions WHERE profession = 'composer')";
    }
}

if ($effet_speciaux) {
    if ($effet_speciaux == "Oui !!") {
        $query .= " AND np.profession = 'visual_effects'";
    }
}

if ($casting) {
    if ($casting == "Toujours") {
        $query .= " AND wb.id_work IN (SELECT id_work FROM work_principals WHERE category IN ('actor', 'actress') AND id_person IN (SELECT id_person FROM name_knownForTitles GROUP BY id_person HAVING COUNT(*) > 10))";
    } else if ($casting == "De temps en temps") {
        $query .= " AND wb.id_work IN (SELECT id_work FROM work_principals WHERE category IN ('actor', 'actress') AND id_person IN (SELECT id_person FROM name_knownForTitles GROUP BY id_person HAVING COUNT(*) <= 10))";
    }
}

if ($duree) {
    if ($duree == "Moins d'une heure") {
        $query .= " AND wb.runtimeMinutes < 59";
    } else if ($duree == "Entre 1h et 1h30") {
        $query .= " AND wb.runtimeMinutes BETWEEN 60 AND 89";
    } else if ($duree == "Entre 1h30 et 2h") {
        $query .= " AND wb.runtimeMinutes BETWEEN 90 AND 119";
    } else {
        $query .= " AND wb.runtimeMinutes > 120";
    }
}

if ($provenance) {
    switch ($provenance) {
        case "Asie":
            $query .= " AND wa.region IN ('" . implode("','", $asie) . "')";
            break;
        case "Afrique":
            $query .= " AND wa.region IN ('" . implode("','", $afrique) . "')";
            break;
        case "Amérique":
            $query .= " AND wa.region IN ('" . implode("','", $amerique) . "')";
            break;
        case "Europe":
            $query .= " AND wa.region IN ('" . implode("','", $europe) . "')";
            break;
        default:
            if (isset($country[$provenance])) {
                $query .= " AND wa.region = '" . $country[$provenance] . "'";
            }
            break;
    }
}

if ($genres) {
    $query .= " AND ( wg.genre = '" . $genres[0] . "'";
    for ($i = 1; $i < count($genres); $i++) {
        if ($i == 1 && $genres[$i] != $genres[0]) {
            $query .= " AND wg.genre = '" . $genres[$i] . "'";
        } else {
            $query .= " OR wg.genre = '" . $genres[$i] . "'";
        }
    }
}

if ($moyenne_age_ami){
    if ($moyenne_age_ami < 20) {
        $query .= " OR wg.genre = 'Animation'";
    } else if ($moyenne_age_ami >= 20 && $moyenne_age_ami < 30) {
        $query .= " OR wg.genre = 'Action'";
    } else if ($moyenne_age_ami >= 30 && $moyenne_age_ami < 40) {
        $query .= " OR wg.genre = 'Mystery'";
    } else {
        $query .= " OR wg.genre = 'History'";
    }
}

if ($majorite_genre_ami){
    if ($majorite_genre_ami == 'homme') {
        $query .= " OR wg.genre = 'Action'";
    } else if ($majorite_genre_ami == 'femme') {
        $query .= " OR wg.genre = 'Drama'";
    } else if ($majorite_genre_ami == "autre") {
        $query .= " OR wg.genre = 'Film-Noir'";
    }
}

$query .= ")";

if ($annee) {
    if ($annee == "Avant 1980") {
        $query .= " AND wb.startYear < 1979";
        $liste_avoir = $bdd->prepare("SELECT DISTINCT wb.id_work, wb.primaryTitle FROM work_basics wb JOIN element_liste el ON wb.id_work = el.id_work JOIN listes l ON el.id_liste = l.id_liste WHERE l.id_user = :id_user AND l.nom = 'À voir' AND wb.startYear < 1979 ORDER BY RAND() LIMIT 1;");
        $liste_avoir->execute(['id_user' => $id_user]);
    } else if ($annee == "1980-1990") {
        $query .= " AND wb.startYear BETWEEN 1980 AND 1989";
        $liste_avoir = $bdd->prepare("SELECT DISTINCT wb.id_work, wb.primaryTitle FROM work_basics wb JOIN element_liste el ON wb.id_work = el.id_work JOIN listes l ON el.id_liste = l.id_liste WHERE l.id_user = :id_user AND l.nom = 'À voir' AND wb.startYear BETWEEN 1980 AND 1989 ORDER BY RAND() LIMIT 1;");
        $liste_avoir->execute(['id_user' => $id_user]);
    } else if ($annee == "1990-2000") {
        $query .= " AND wb.startYear BETWEEN 1990 AND 1999";
        $liste_avoir = $bdd->prepare("SELECT DISTINCT wb.id_work, wb.primaryTitle FROM work_basics wb JOIN element_liste el ON wb.id_work = el.id_work JOIN listes l ON el.id_liste = l.id_liste WHERE l.id_user = :id_user AND l.nom = 'À voir' AND wb.startYear BETWEEN 1990 AND 1999 ORDER BY RAND() LIMIT 1;");
        $liste_avoir->execute(['id_user' => $id_user]);
    } else if ($annee == "2000-2010"){
        $query .= " AND wb.startYear BETWEEN 2000 AND 2009";
        $liste_avoir = $bdd->prepare("SELECT DISTINCT wb.id_work, wb.primaryTitle FROM work_basics wb JOIN element_liste el ON wb.id_work = el.id_work JOIN listes l ON el.id_liste = l.id_liste WHERE l.id_user = :id_user AND l.nom = 'À voir' AND wb.startYear BETWEEN 2000 AND 2009 ORDER BY RAND() LIMIT 1;");
        $liste_avoir->execute(['id_user' => $id_user]);
    } else if ($annee == "2010-2020") {
        $query .= " AND wb.startYear BETWEEN 2010 AND 2019";
        $liste_avoir = $bdd->prepare("SELECT DISTINCT wb.id_work, wb.primaryTitle FROM work_basics wb JOIN element_liste el ON wb.id_work = el.id_work JOIN listes l ON el.id_liste = l.id_liste WHERE l.id_user = :id_user AND l.nom = 'À voir' AND wb.startYear BETWEEN 2010 AND 2019 ORDER BY RAND() LIMIT 1;");
        $liste_avoir->execute(['id_user' => $id_user]);
    } else if ($annee == "Après 2020") {
        $query .= " AND wb.startYear > 2020";
        $liste_avoir = $bdd->prepare("SELECT DISTINCT wb.id_work, wb.primaryTitle FROM work_basics wb JOIN element_liste el ON wb.id_work = el.id_work JOIN listes l ON el.id_liste = l.id_liste WHERE l.id_user = :id_user AND l.nom = 'À voir' AND wb.startYear > 2020 ORDER BY RAND() LIMIT 1;");
        $liste_avoir->execute(['id_user' => $id_user]);
    } else if ($annee == "Cette année"){
        $query .= " AND wb.startYear = :annee_actuel";
        $liste_avoir = $bdd->prepare("SELECT DISTINCT wb.id_work, wb.primaryTitle FROM work_basics wb JOIN element_liste el ON wb.id_work = el.id_work JOIN listes l ON el.id_liste = l.id_liste WHERE l.id_user = :id_user AND l.nom = 'À voir' AND wb.startYear = :annee_actuel ORDER BY RAND() LIMIT 1;");
        $liste_avoir->execute(['id_user' => $id_user, 'annee_actuel' => $annee_actuel]);
    }
    $res_liste_avoir = $liste_avoir->fetch();
}

foreach($res_liste_dejavu as $elem_liste_dejavu) {
    $query .= " AND id_work != " . $elem_liste_dejavu . "";
}

if (empty($res_liste_avoir)) {
    $query .= " ORDER BY RAND() LIMIT 5;";
} else {
    $query .= " ORDER BY RAND() LIMIT 4;";
}

try {
    $stmt = $bdd->prepare($query);
    if ($annee == "Cette année") {
        $stmt->execute(['annee_actuel' => $annee_actuel]);
    } else {
        $stmt->execute();
    }
    
    $movies = [];
    
    while ($line = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $movies[] = $line;
    }
    
    if ($avoir && $avoir == "Oui" && isset($res_liste_avoir)) {
        $movies[] = $res_liste_avoir;  
    }

    echo json_encode(['movies' => $movies, 'req' => $query]);
} catch (PDOException $e) {
    echo json_encode(['erreur' => $e->getMessage()]);
}
?>
