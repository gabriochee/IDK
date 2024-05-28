<?php
$serverAddress = "152.228.217.19";
$username = "distant";
$password = "LEG2024IDKdistant!";

try {
    $bdd = new PDO("mysql:host=$serverAddress;dbname=IMDb;port=3306", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage(); 
}

global $bdd;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = json_decode(file_get_contents('php://input'), true);

$avis = isset($data[0]) ? $data[0] : '';
$bande_son = isset($data[1]) ? $data[1] : '';
$effet_speciaux = isset($data[2]) ? $data[2] : '';
$categorie = isset($data[3]) ? $data[3] : '';
$casting = isset($data[4]) ? $data[4] : '';
$duree = isset($data[5]) ? $data[5] : '';
$provenance = isset($data[6]) ? $data[6] : '';
$genre = isset($data[7]) ? $data[7] : '';
$annee = isset($data[8]) ? $data[8] : '';
$connected = isset($data[9]) ? $data[9] : '';


$query = "SELECT primaryTitle FROM work_basics WHERE 1=1";
$params = [];

if ($avis) {
    if ($avis == 'Toujours') {
        $query .= " id_work FROM work_ratings WHERE averageRating > 8.5";
    } else if ($avis == 'De temps en temps') {
        $query .= " id_work FROM work_ratings WHERE averageRating > 7.5";
    } else {
        $query .= ""; // Si ne regarde jamais les avis de regarder un film on ne filtre pas par rapport aux notes
    }
} // else Erreur ? gere le cas de figure ou l'user arrive à remplir le form sans repondre à ses question ? 

if ($bande_son) {
    if($bande_son == "Oui !!") {

    }
} // mettre plus a la fin ?

if ($effet_speciaux) {
    if($effet_speciaux == "Tendance") {

    } else if ($effet_speciaux == "Nouveauté") {

    } else if ($effet_speciaux == "Recommandation de l\'entourage") {

    } else {

    }
}

if ($casting) {
    if ($casting == 'Toujours') {
        
    } else if ($casting == 'De temps en temps') {
        
    } else {
        // Si ne regarde jamais les avis de regarder un film on ne filtre pas par rapport aux notes
    }
}




if ($genre) {
    $query .= " AND genre = :genre";
    $params[':genre'] = $genre;
}

// Filtrer par période (récent ou ancien)
if ($period) {
    if ($period == 'Récents') {
        $query .= " AND year >= 2000";
    } elseif ($period == 'Anciens') {
        $query .= " AND year < 2000";
    }
}

$stmt = $bdd->prepare($query);
$stmt->execute($params);
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retourner les résultats filtrés en JSON
echo json_encode(['movies' => $movies]);
?>

            question: 'Regardez vous les avis avant de visionner une oeuvre ?',
            options: ['Toujours', 'De temps en temps', 'Jamais']
        
        {
            question: 'La composition musical est elle importante pour vous ?',
            options: ['Oui !!', 'Non, je n\'y fais pas attention']
        },
        {
            question: 'Accorder-vous de l\'importance au effet-spéciaux d\'une oeuvre ?',
            options: ['Oui !!', 'Non, je n\'y fais pas attention']
        },
        {
            question: 'Lorsque vous recherchez une oeuvre à visionner vers qu\'elle catégorie vous orientez vous ?',
            options: ['Tendance', 'Nouveauté', 'Recommandation de l\'entourage', 'Aucun, au hasard'] 
            
        },
        {
            question: 'Accorder-vous de l\'importance au casting d\'une oeuvre ?',
            options: ['Toujours', 'De temps en temps', 'Jamais']
        },
        {
            question: 'Qu\'elle serais la durée souhaitez ?', 
            options: ['Moins d\'une heure', 'Entre 1h et 1h30', 'Entre 1h30 et 2h', 'Plus de 2h']
            Facilement traitable :
        },
        {
            question: 'De qu\'elle pays d\'origine préféreriez-vous ? (3 maximum)',
            options: ['Etats-Unies', 'Inde', 'Chine', 'Japon', 'Angleterre', 'Allemagne', 'France', 'Corée du Sud', 'Bresil', 'Nigéria', 'Italie', 'Asie', 'Afrique', 'Amérique', 'Europe', 'Je ne sais pas']
            Facilement traitable :
        },
        {
            question: 'Qu\'elle genre vous attire ? (3 maximum)',
            options: ['Musical', 'Action', 'Romance', 'Talk-Show', 'Western', 'Sport', 'Drama', 'Sci-Fi', 'Animation', 'Documentary', 'Thriller', 'Film-Noir', 'Music', 'Comedy', 'Horror', 'Family', 'Reality-TV', 'Crime', 'Adventure', 'Game-Show', 'Biography', 'Mistery', 'History', 'News', 'Fantasy', 'War']
            Facilement traitable :
        },
        {
            question: 'De quelle année ?',
            options: ['Avant 1980', '1980-1990', '1990-2000', '2000-2010', '2010-2020', 'Après 2020', 'Cette année']
            Facilement traitable :
        },
        {
            question: 'Voulez vous prendre en comptes les film de votre liste à voir ?',
            options: ['Oui !!', 'Non']
        }
    ];