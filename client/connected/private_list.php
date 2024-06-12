<?php
require_once('../../inc/php/db.php');

session_start();



if (isset($_GET['id_liste'])) {
    $req = $bdd->prepare("SELECT date_creation, details, statut, id_user, nom FROM listes WHERE id_liste = :id_liste;");
    $req->bindParam(":id_liste", $_GET['id_liste']);
    $req->execute();

    $res = $req->fetchAll();
    $nomListe = $res[0]['nom'];
    $isOwner = $res[0]['id_user'] == $_SESSION['id_user'];

    $req = $bdd->prepare("SELECT pseudo FROM utilisateur WHERE id_user = :id_user;");
    $req->bindParam(":id_user", $_SESSION['id_user']);
    $req->execute();

    $res = $req->fetchAll();
    $pseudoProprietaire = $res[0]['pseudo'];
} else {
    header("Location: ../connected/home.php");
    exit();
}
?>
<?php require_once('../../inc/php/scraping_log.php'); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/style/style.css">
    <link rel="stylesheet" href="../../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>

<body id="connected_private_list" class="no-x-overflow">
    <?php require_once('../../inc/php/db.php'); ?>
    <?php require_once('../../inc/connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex flex-column text-center">
            <h3 class="mt-5 mx-auto col-6"><?php echo $nomListe; ?></h3>
            <p class="fs-6 m-0">Crée le : 12/12/2023 13:12:23</p>
            <p class="fs-6 m-0">Dèrnière maj le : 12/12/2023 13:12:23</p>

        </div>

        <div class="container mt-sm-0 mt-5">
            <h5>De <a href="#" class="link-dark link-underline-opacity-0 link-underline-opacity-100-hover"><?php echo $pseudoProprietaire; ?></a>
                <br>
                <br>
                123 abonnées
                <br>
                123 critiques publiques
                <br>
                12 listes publiques
                <br>
                <br>
                inscrit depuis jj/mm/aaaa</h4>
        </div>

        <!-- besoin de changer la taille verticale de cette div, si vous trouvez comment faire dites moi svp. -->
        <div class="container m-0 mt-5 p-0 w-75 list-height m-auto border border-3 border-dark rounded-3 overflow-auto no-overflow-x" style="background-color: #CFDBD5;">
            <div class="d-lg-flex row gx-2 gy-3 px-5 py-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
                <?php
                if (isset($_GET['id_liste'])) {
                    $req = $bdd->prepare("SELECT element_liste.id_work, work_basics.primaryTitle, work_basics.startYear FROM element_liste JOIN work_basics ON element_liste.id_work = work_basics.id_work WHERE id_liste = " . $_GET['id_liste'] . ";");
                    $req->execute();

                    $res;

                    while (($res = $req->fetch()) != null) {
                        $filmName = $res['primaryTitle'];
                        $filmId = $res['id_work'];
                        $filmYear = $res['startYear'];
                        require_once('../../inc/components/card.php');
                    }
                }
                ?>
            </div>
        </div>

        <div class="container-fluid text-center my-5">
            <div>
                <button class="btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-4 col-md-3" data-bs-toggle="modal" data-bs-target="#addMovieModal">Ajouter un film</button>

                <div class="modal fade" id="addMovieModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Ajouter un film</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="search" class="form-control" id="search-movie-input" onkeydown="searchKeywordMovieList()">
                                <div class="d-flex flex-column align-items-start" id="results-movie"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-4 col-md-3">Partager !</a>
            </div>

            <?php if ($isOwner) {
                echo
                '<button class="btn btn-primary btn-sm btn-danger border border-dark border-2 rounded-3 fs-4 col-md-3 mt-5" data-bs-toggle="modal" data-bs-target="#deleteListModal">Supprimer la liste</button>

            <div class="modal fade" id="deleteListModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Supprimer la liste</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Êtes vous sûr de vouloir supprimer cette liste ?</p>
                            <a href="../../inc/php/delete_list.php?id_liste=' . $_GET['id_liste'] . '" type="button" class="btn btn-danger">Supprimer</a>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>

        <div class="container-fluid col-10 fs-5 border border-2 border-dark overflow-auto max-height" style="background-color : #CFDBD5;">
            <ul>
                <?php
                for ($i = 1; $i <= 11; $i++) {
                    echo "<li class='py-2'> Ami $i - <a href='#' class='link-dark link-underline-opacity-0 link-underline-opacity-100-hover'>Ajouter</a></li>";
                }
                ?>
            </ul>
        </div>
    </main>
    <?php require_once('../../inc/connected/footer.php'); ?>
    <?php if ($isOwner) {
        echo '<script src="../../inc/js/delete_list_movie.js"></script>';
    } ?>
    <script>
        const id_liste = <?php echo $_GET['id_liste']; ?>;
    </script>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/js/private_list.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>