<?php 
switch ($file_location) {
    case "home":
        $file_location = "Accueil";
        break;
    case "about":
        $file_location = "A propos";
        break;
    case "terms_and_conditions":
        $file_location = "Conditions général";
        break;
    default:
        handle_error("Page non trouvé");
}

$stmt = $bdd->prepare("SELECT id_bloc, page_appartenance, titre, corps FROM contenu WHERE page_appartenance = :file_location");
$stmt->execute(['file_location' => $file_location]); 
$results = $stmt->fetchAll();
?>