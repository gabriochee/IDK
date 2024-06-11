<?php 
session_start();

if(!(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin')) {
    header("Location: ../client/not_connected/login.php");
    exit();
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
                    <h1 class="text-center mt-4">Page : À Propos</h1>
                    <p class="text-end">Date de modifications : 01/01/2024 00:00</p>
                    <hr class="featurette-divider my-2">
                    
                    <div class="container col-9 mb-5">
                        <h3></h3>
                        <p>Bienvenue sur IDK, créé par Gabriel Pla, Léo Belarbi et Eric Sang en 2024. Notre plateforme est une application web dynamique conçue pour simplifier la découverte de films et de séries personnalisés. Notre objectif est de révolutionner votre expérience cinématographique en vous offrant des recommandations sur mesure, basées sur vos préférences et vos habitudes de visionnage.</p>
                        <br/>

                        <h3>Comment ça marche ?</h3>
                        <p>Notre approche est simple : nous utilisons un questionnaire interactif, accessible à tous les utilisateurs, pour comprendre vos goûts cinématographiques. Ce questionnaire, composé d'une dizaine de questions, vous guidera à travers vos préférences et vos attentes. À la fin, vous recevrez une sélection personnalisée de 5 films ou séries qui correspondent le mieux à vos critères.<br/>Mais notre personnalisation ne s'arrête pas là. Pour les utilisateurs connectés, nous offrons la possibilité de préciser davantage leurs préférences en fournissant une liste de films déjà visionnés et en ajoutant des critères supplémentaires. Cette étape permet d'affiner encore plus les recommandations et de les rendre uniques à chaque utilisateur.</p>
                        <br/>

                        <h3>Une expérience sociale</h3>
                        <p>En plus de vous proposer des recommandations sur mesure, notre plateforme se veut également sociale. Une fois inscrit ou connecté, vous accéderez à une interface conviviale où vous pourrez partager vos avis sur les films et séries que vous avez vus, constituer une liste de visionnage future, et découvrir les nouveautés correspondant à vos critères de prédilection.<br/>Vous pourrez également interagir avec d'autres utilisateurs en les ajoutant à vos contacts, échanger des messages privés via notre système de messagerie intégré, et même partager vos découvertes cinématographiques avec eux.</p>
                        <br/>

                        <h3>Technologie et innovation</h3>
                        <p>Le cœur de notre plateforme repose sur un modèle de classification des films et séries efficace et évolutif. Ce modèle, constamment mis à jour, est la clé de voûte de nos recommandations personnalisées, de la génération de notre newsletter hebdomadaire, et de l'affichage des nouveautés sur notre plateforme.Nous attachons également une grande importance à la convivialité de notre interface utilisateur.<br/>Notre arbre de questions est conçu pour être intuitif et non intrusif, facilitant ainsi la création du compte utilisateur et le processus de recommandation.</p>
                        <br/>
                        
                        <h3>Engagement envers nos utilisateurs</h3>
                        <p>Nous nous engageons à offrir à chaque utilisateur un contrôle total sur son expérience cinématographique. Vous avez le pouvoir de découvrir de nouveaux films et séries qui correspondent parfaitement à vos goûts, tout en bénéficiant d'un contrôle total sur le processus de recommandation.</p>
                        <br/>

                        <h3>Notre mission</h3>
                        <p>Chez IDK, nous croyons que chaque film et série mérite d'être découvert. Notre mission est de vous aider à trouver ces pépites cinématographiques qui enrichiront votre vie et stimuleront votre imagination.<br/>Merci de faire partie de notre communauté et de nous permettre de vous accompagner dans votre voyage cinématographique.</p>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-75 my-3" id="modifier-about">Modifier</button>
                </div>

                <form method="post" id="form-about">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="titre-bloc1" class="form-label">Titre du bloc 1</label>
                            <textarea class="form-control" id="titre-bloc1" name="titre-bloc1" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc1" class="form-label">Texte du bloc 1</label>
                            <textarea class="form-control" id="texte-bloc1" name="texte-bloc1"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc2" class="form-label">Titre du bloc 2</label>
                            <textarea class="form-control" id="titre-bloc2" name="titre-bloc2" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc2" class="form-label">Texte du bloc 2</label>
                            <textarea class="form-control" id="texte-bloc2" name="texte-bloc2"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc3" class="form-label">Titre du bloc 3</label>
                            <textarea class="form-control" id="titre-bloc3" name="titre-bloc3" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc3" class="form-label">Texte du bloc 3</label>
                            <textarea class="form-control" id="texte-bloc3" name="texte-bloc3"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc4" class="form-label">Titre du bloc 4</label>
                            <textarea class="form-control" id="titre-bloc4" name="titre-bloc4" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc4" class="form-label">Texte du bloc 4</label>
                            <textarea class="form-control" id="texte-bloc4" name="texte-bloc4"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc5" class="form-label">Titre du bloc 5</label>
                            <textarea class="form-control" id="titre-bloc5" name="titre-bloc5" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc5" class="form-label">Texte du bloc 5</label>
                            <textarea class="form-control" id="texte-bloc5" name="texte-bloc5"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc6" class="form-label">Titre du bloc 6</label>
                            <textarea class="form-control" id="titre-bloc6" name="titre-bloc6" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc6" class="form-label">Texte du bloc 6</label>
                            <textarea class="form-control" id="texte-bloc6" name="texte-bloc6"></textarea>
                        </div>
                        <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 my-3" type="submit" value="">Enregistrement</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script src="../inc/js/edit_about.js"></script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>