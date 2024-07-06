<?php
session_start();
require_once('db.php');

$answers = json_decode(file_get_contents('php://input'), true);

$avis = isset($answers[0]) ? $answers[0] : '';
$bande_son = isset($answers[1]) ? $answers[1] : '';
$effet_speciaux = isset($answers[2]) ? $answers[2] : '';
$casting = isset($answers[3]) ? $answers[3] : '';
$duree = isset($answers[4]) ? $answers[4] : '';
$provenance = isset($answers[5]) ? $answers[5] : '';
$genres = isset($answers[6]) ? $answers[6] : [];
$annee = isset($answers[7]) ? $answers[7] : '';

$asie = ['AF', 'AM', 'AZ', 'BH', 'BD', 'BT', 'BN', 'KH', 'CN', 'GE', 'IN', 'ID', 'IR', 'IQ', 'IL', 'JP', 'JO', 'KZ', 'KW', 'KG', 'LA', 'LB', 'MY', 'MV', 'MN', 'MM', 'NP', 'KP', 'KR', 'OM', 'PK', 'PS', 'PH', 'QA', 'SA', 'SG', 'LK', 'SY', 'TW', 'TJ', 'TH', 'TL', 'TR', 'TM', 'AE', 'UZ', 'VN', 'YE'];
$afrique = ['DZ', 'AO', 'BJ', 'BW', 'BF', 'BI', 'CM', 'CV', 'CF', 'TD', 'KM', 'CG', 'CD', 'CI', 'DJ', 'EG', 'GQ', 'ER', 'ET', 'GA', 'GM', 'GH', 'GN', 'GW', 'KE', 'LS', 'LR', 'LY', 'MG', 'MW', 'ML', 'MR', 'MU', 'YT', 'MA', 'MZ', 'NA', 'NE', 'NG', 'RE', 'RW', 'ST', 'SN', 'SC', 'SL', 'SO', 'ZA', 'SS', 'SD', 'SZ', 'TZ', 'TG', 'TN', 'UG', 'EH', 'ZM', 'ZW'];
$europe = ['AL', 'AD', 'AM', 'AT', 'AZ', 'BY', 'BE', 'BA', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'GE', 'DE', 'GR', 'HU', 'IS', 'IE', 'IT', 'KZ', 'XK', 'LV', 'LI', 'LT', 'LU', 'MT', 'MD', 'MC', 'ME', 'NL', 'MK', 'NO', 'PL', 'PT', 'RO', 'RU', 'SM', 'RS', 'SK', 'SI', 'ES', 'SE', 'CH', 'TR', 'UA', 'GB', 'VA'];
$amerique = ['AS', 'AI', 'AG', 'AR', 'AW', 'BS', 'BB', 'BZ', 'BM', 'BO', 'BR', 'VG', 'CL', 'CO', 'CR', 'CU', 'DM', 'DO', 'EC', 'SV', 'FK', 'GF', 'GL', 'GD', 'GP', 'GT', 'GY', 'HT', 'HN', 'JM', 'MQ', 'MX', 'MS', 'AN', 'NI', 'PA', 'PY', 'PE', 'PR', 'BL', 'KN', 'LC', 'MF', 'PM', 'VC', 'SR', 'TT', 'TC', 'VI', 'UY', 'VE'];
$country = ['Etats-Unis' => 'US', 'Inde' => 'IN', 'Chine' => 'CN', 'Japon' => 'JP', 'Angleterre' => 'GB', 'Allemagne' => 'DE', 'France' => 'FR', 'Corée du Sud' => 'KR', 'Brésil' => 'BR', 'Nigéria' => 'NG', 'Italie' => 'IT'];
$annee_actuel = date("Y");
$query = "SELECT DISTINCT wb.id_work, primaryTitle FROM work_basics wb 
JOIN work_ratings wr ON wb.id_work = wr.id_work 
JOIN work_akas wa ON wb.id_work = wa.id_work 
JOIN work_genres wg ON wb.id_work = wg.id_work 
JOIN work_principals wp ON wb.id_work = wp.id_work 
JOIN name_basics nb ON wp.id_person = nb.id_person 
JOIN name_professions np ON wp.id_person = np.id_person WHERE 1=1";

$requete = [];

if ($avis) {
    if ($avis == 'Toujours') {
        $query .= " AND wr.averageRating > 8.5";
        $requete[] = "Filtre avis: Toujours (Note > 8.5)";
    } else if ($avis == 'De temps en temps') {
        $query .= " AND wr.averageRating > 7.5";
        $requete[] = "Filtre avis: De temps en temps (Note > 7.5)";
    }
}

if ($bande_son) {
    if ($bande_son == "Oui !!") {
        $query .= " AND wp.category = 'composer' AND nb.id_person IN (SELECT id_person FROM name_professions WHERE profession = 'composer')";
        $requete[] = "Filtre bande sonore: Oui (Composer)";
    }
}

if ($effet_speciaux) {
    if ($effet_speciaux == "Oui !!") {
        $query .= " AND np.profession = 'visual_effects'";
        $requete[] = "Filtre effets spéciaux: Oui (Visual Effects)";
    }
}

if ($casting) {
    if ($casting == "Toujours") {
        $query .= " AND wb.id_work IN (SELECT id_work FROM work_principals WHERE category IN ('actor', 'actress') AND id_person IN (SELECT id_person FROM name_knownForTitles GROUP BY id_person HAVING COUNT(*) > 10))";
        $requete[] = "Filtre casting: Toujours (Acteurs connus)";
    } else if ($casting == "De temps en temps") {
        $query .= " AND wb.id_work IN (SELECT id_work FROM work_principals WHERE category IN ('actor', 'actress') AND id_person IN (SELECT id_person FROM name_knownForTitles GROUP BY id_person HAVING COUNT(*) <= 10))";
        $requete[] = "Filtre casting: De temps en temps (Acteurs moins connus)";
    }
}

if ($duree) {
    if ($duree == "Moins d'une heure") {
        $query .= " AND wb.runtimeMinutes < 59";
        $requete[] = "Filtre durée: Moins d'une heure";
    } else if ($duree == "Entre 1h et 1h30") {
        $query .= " AND wb.runtimeMinutes BETWEEN 60 AND 89";
        $requete[] = "Filtre durée: Entre 1h et 1h30";
    } else if ($duree == "Entre 1h30 et 2h") {
        $query .= " AND wb.runtimeMinutes BETWEEN 90 et 119";
        $requete[] = "Filtre durée: Entre 1h30 et 2h";
    } else {
        $query .= " AND wb.runtimeMinutes > 120";
        $requete[] = "Filtre durée: Plus de 2h";
    }
}

if ($provenance) {
    switch ($provenance) {
        case "Asie":
            $query .= " AND wa.region IN ('" . implode("','", $asie) . "')";
            $requete[] = "Filtre provenance: Asie";
            break;
        case "Afrique":
            $query .= " AND wa.region IN ('" . implode("','", $afrique) . "')";
            $requete[] = "Filtre provenance: Afrique";
            break;
        case "Amérique":
            $query .= " AND wa.region IN ('" . implode("','", $amerique) . "')";
            $requete[] = "Filtre provenance: Amérique";
            break;
        case "Europe":
            $query .= " AND wa.region IN ('" . implode("','", $europe) . "')";
            $requete[] = "Filtre provenance: Europe";
            break;
        default:
            if (isset($country[$provenance])) {
                $query .= " AND wa.region = '" . $country[$provenance] . "'";
                $requete[] = "Filtre provenance: " . $provenance;
            }
            break;
    }
}

if ($genres) {
    $query .= " AND ( wg.genre = '" . $genres[0] . "'";
    foreach ($genres as $genre) {
        $query .= " OR wg.genre = '" . $genre . "'";
    }
    $query .= ")";
    $requete[] = "Filtre genres: " . implode(", ", $genres);
}

if ($annee) {
    if ($annee == "Avant 1980") {
        $query .= " AND wb.startYear < 1979";
        $requete[] = "Filtre année: Avant 1980";
    } else if ($annee == "1980-1990") {
        $query .= " AND wb.startYear BETWEEN 1980 AND 1989";
        $requete[] = "Filtre année: 1980-1990";
    } else if ($annee == "1990-2000") {
        $query .= " AND wb.startYear BETWEEN 1990 AND 1999";
        $requete[] = "Filtre année: 1990-2000";
    } else if ($annee == "2000-2010"){
        $query .= " AND wb.startYear BETWEEN 2000 AND 2009";
        $requete[] = "Filtre année: 2000-2010";
    } else if ($annee == "2010-2020") {
        $query .= " AND wb.startYear BETWEEN 2010 AND 2019";
        $requete[] = "Filtre année: 2010-2020";
    } else if ($annee == "Après 2020") {
        $query .= " AND wb.startYear > 2020";
        $requete[] = "Filtre année: Après 2020";
    } else if ($annee == "Cette année"){
        $query .= " AND wb.startYear = :annee_actuel";
        $requete[] = "Filtre année: Cette année";
    }
}

$query .= " ORDER BY RAND() LIMIT 5;";
$requete[] = "Requete final : " . $query;

try {
    $stmt = $bdd->prepare($query);
    if ($annee == "Cette année") {
        $stmt->execute(['annee_actuel' => $annee_actuel]);
    } else {
        $stmt->execute();
    }
    $movies = $stmt->fetchAll();    
    echo json_encode(['movies' => $movies, 'requete' => $requete]);
} catch (PDOException $e) {
    echo json_encode(['erreur' => $e->getMessage(), 'requete' => $requete]);
}
?>
