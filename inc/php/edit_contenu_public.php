<?php 
require_once('../inc/php/access.php');

switch ($file_location) {
    case "edit_home":
        $file_location = "Accueil";
        break;
    case "edit_about":
        $file_location = "A propos";
        break;
    case "edit_terms_and_conditions":
        $file_location = "Conditions général";
        break;
    default:
        handle_error("Page non trouvé");
}

// Traitement du formulaire POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'titre-bloc') === 0) {
            $id_bloc = str_replace('titre-bloc', '', $key);
            $titre = $_POST['titre-bloc' . $id_bloc];
            $corps = $_POST['texte-bloc' . $id_bloc];
            $id_user = $_SESSION['id_user'];  
            $date_maj = date('Y-m-d H:i:s');

            // Récupérer les anciens titres et corps
            $stmt = $bdd->prepare("SELECT titre, corps FROM contenu WHERE id_bloc = :id_bloc");
            $stmt->execute(['id_bloc' => $id_bloc]); 
            $ancien_contenu = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si le contenu a changé
            if ($titre !== $ancien_contenu['titre'] || $corps !== $ancien_contenu['corps']) {
                // Mise à jour du contenu 
                $stmt = $bdd->prepare("UPDATE contenu SET titre = :titre, corps = :corps WHERE id_bloc = :id_bloc");
                $stmt->execute([
                    'titre' => $titre,
                    'corps' => $corps,
                    'id_bloc' => $id_bloc
                ]);

                // Enregistrement dans la table administration_contenu
                $stmt = $bdd->prepare("INSERT INTO administration_contenu (id_user, id_bloc, date_maj, before_maj_titre, before_maj_corps, after_maj_titre, after_maj_corps) VALUES (:id_user, :id_bloc, :date_maj, :before_maj_titre, :before_maj_corps, :after_maj_titre, :after_maj_corps)");
                $stmt->execute([
                    'id_user' => $id_user,
                    'id_bloc' => $id_bloc,
                    'date_maj' => $date_maj,
                    'before_maj_titre' => $ancien_contenu['titre'],
                    'before_maj_corps' => $ancien_contenu['corps'],
                    'after_maj_titre' => $titre,
                    'after_maj_corps' => $corps
                ]);
            }
        }
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

if (!isset($_GET['action']) || $_GET['action'] == 'display') {
    $stmt = $bdd->prepare("SELECT id_bloc, page_appartenance, titre, corps FROM contenu WHERE page_appartenance = :file_location");
    $stmt->execute(['file_location' => $file_location]); 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $bdd->prepare("SELECT MAX(date_maj) as last_modif FROM administration_contenu WHERE id_bloc IN (SELECT id_bloc FROM contenu WHERE page_appartenance = :file_location)");
    $stmt->execute(['file_location' => $file_location]); 
    $last_modif = $stmt->fetch(PDO::FETCH_ASSOC)['last_modif'];

    $stmt = $bdd->prepare("SELECT utilisateur.nom, utilisateur.prenom FROM utilisateur JOIN administration_contenu ON utilisateur.id_user = administration_contenu.id_user WHERE administration_contenu.date_maj = :last_modif");
    $stmt->execute(['last_modif' => $last_modif]); 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>