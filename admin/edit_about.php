<?php 
session_start();

require_once('../inc/php/db.php'); 

if (!(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin')) {
    header("Location: ../client/not_connected/login.php");
    exit();
}

$url_demandee = $_SERVER['REQUEST_URI'];
$segments_url = explode('/', $url_demandee);
$nom_page = end($segments_url);

switch ($nom_page) {
    case "edit_home.php":
        $nom_page = "Accueil";
        break;
    case "edit_about.php":
        $nom_page = "A propos";
        break;
    case "edit_terms_and_conditions.php":
        $nom_page = "Conditions général";
        break;
    default:
        die("Page non trouvée");
}
// Traitement du formulaire POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'titre-bloc') === 0) {
            $id_bloc = str_replace('titre-bloc', '', $key);
            $titre = $_POST['titre-bloc' . $id_bloc];
            $corps = $_POST['texte-bloc' . $id_bloc];
            $date_maj = date('Y-m-d H:i:s');
            $id_user = $_SESSION['id_user'];  // Supposons que l'ID de l'utilisateur est stocké dans la session

            // Récupérer les anciens titres et corps
            $stmt = $bdd->prepare("SELECT titre, corps, date_maj FROM contenu WHERE id_bloc = :id_bloc");
            $stmt->execute(['id_bloc' => $id_bloc]); 
            $ancien_contenu = $stmt->fetch(PDO::FETCH_ASSOC);

            // Mise à jour du contenu 
            // if $post !== $ancien_contenu ne pas update
            $stmt = $bdd->prepare("UPDATE contenu 
                SET titre = :titre, corps = :corps, date_maj = :date_maj, last_titre = :last_titre, last_corps = :last_corps, last_date_maj = :last_date_maj 
                WHERE id_bloc = :id_bloc");
            $stmt->execute([
                'titre' => $titre,
                'corps' => $corps,
                'date_maj' => $date_maj,
                'last_titre' => $ancien_contenu['titre'],
                'last_corps' => $ancien_contenu['corps'],
                'last_date_maj' => $ancien_contenu['date_maj'],
                'id_bloc' => $id_bloc
            ]);

            // Enregistrement dans la table administration_contenu
            $stmt = $bdd->prepare("INSERT INTO administration_contenu (id_user, id_bloc, date_maj) 
                VALUES (:id_user, :id_bloc, :date_maj)");
            $stmt->execute([
                'id_user' => $id_user,
                'id_bloc' => $id_bloc,
                'date_maj' => $date_maj
            ]);
        }
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

if (!isset($_GET['action']) || $_GET['action'] == 'display') {
    $stmt = $bdd->prepare("SELECT id_bloc, page_appartenance, titre, corps, date_maj, last_titre, last_corps , last_date_maj FROM contenu WHERE page_appartenance = :nom_page");
    $stmt->execute(['nom_page' => $nom_page]); 

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/style/style.css">
    <link rel="stylesheet" href="../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="backoffice_edit_about" class="backoffice">
    <?php require_once('../inc/php/db.php'); ?>
    <?php require_once('../inc/backoffice/header.php');?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/backoffice/sidebar.php');?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="container border border-black rounded-2 border-2 mt-3">
                    <h1 class="text-center mt-4">Page : <?php echo htmlspecialchars($nom_page); ?></h1>
                    <p class="text-end">Date de modifications : <?php echo $results['date_maj']; ?></p>
                    <hr class="featurette-divider my-2">
                    
                    <div class="container col-9 my-5">
                    <?php
                        $content = '';
                        foreach ($results as $line) {
                            $content .= '<h3>' . htmlspecialchars($line['titre']) . '</h3>';
                            $content .= '<p>' . nl2br(htmlspecialchars($line['corps'])) . '</p><br/>';
                        }
                        echo $content;
                    ?>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-75 my-3 d-block" id="modifier-about">Modifier</button>
                </div>

                <form method="POST" id="form-edit-about" class="d-none my-5">
                    <div class="row g-3 p-5">
                    <?php
                        $content2 = '';
                        foreach ($results as $line2) {
                            $content2 .= '<div class="col-12">';
                            $content2 .= '<label for="titre-bloc' . htmlspecialchars($line2['id_bloc']) . '" class="form-label">Titre du bloc ' . htmlspecialchars($line2['id_bloc']) . '</label>';
                            $content2 .= '<textarea class="form-control" id="titre-bloc' . htmlspecialchars($line2['id_bloc']) . '" name="titre-bloc' . htmlspecialchars($line2['id_bloc']) . '">'; 
                            if (isset($line2['titre'])) {
                                $content2 .= htmlspecialchars($line2['titre']);
                            }
                            $content2 .= '</textarea></div>';
                            $content2 .= '<div class="col-12">';
                            $content2 .= '<label for="texte-bloc' . htmlspecialchars($line2['id_bloc']) . '" class="form-label">Texte du bloc ' . htmlspecialchars($line2['id_bloc']) . '</label>';
                            $content2 .= '<textarea class="form-control" id="texte-bloc' . htmlspecialchars($line2['id_bloc']) . '" name="texte-bloc' . htmlspecialchars($line2['id_bloc']) . '">';
                            if (isset($line2['corps'])) {
                                $content2 .= htmlspecialchars($line2['corps']);
                            }
                            $content2 .= '</textarea></div>';
                        }
                        echo $content2;
                    ?>
                        <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 my-3" type="submit" value="">Enregistrement</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script>
        const newAdmin = document.getElementById("form-edit-about");
        const btnNewAdmin = document.getElementById("modifier-about");
        btnNewAdmin.addEventListener("click", function() {
            newAdmin.classList.replace("d-none", "d-block");
            btnNewAdmin.classList.replace("d-block", "d-none");
        });
    </script>
    <script src="../inc/js/edit_about.js"></script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>















