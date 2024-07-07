<?php require_once('../../inc/php/access.php'); ?>
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

<body id="oeuvre">
    <?php require_once('../../inc/php/db.php'); ?>
    <?php require_once('../../inc/php/function_oeuvre.php'); ?>
    <?php require_once('../../inc/components/not_connected/header.php'); ?>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-10 img-fluid img-custom-1">
                    <img src="" id="movie-poster" alt="affiche de l'oeuvre">
                </div>
                <div class="col-12 col-lg-5">
                    <div>
                        <h1 class="m-1 mb-3" id="movie-title"><?php echo $rep1['primaryTitle']; ?></h1>
                        <p class="m-1" id="movie-year">Durée : <?php echo $rep1['runtimeMinutes']; ?> minutes</p>
                        <p class="m-1">Date de sortie : <?php echo $rep1['startYear']; ?></p>
                        <p class="m-1">Genres : <?php foreach ($rep3 as $genre) { echo $genre['genre'] . ((end($rep3) != $genre) ? ", " : ""); } ?></p>
                        <p class="m-1">Acteurs principaux : <?php foreach ($rep5 as $acteur) { echo $acteur["name"] . ((end($rep5) != $acteur) ? ", " : ""); } ?></p>
                        <p class="m-1">Réalisateur : <?php foreach ($rep6 as $realisateur) { echo $realisateur["name"] . ((end($rep6) != $realisateur) ? ", " : ""); } ?></p>
                        <p class="m-1">Producteur : <?php foreach ($rep7 as $producteur) { echo $producteur["name"] . ((end($rep7) != $producteur) ? ", " : ""); } ?></p>
                    </div>
                    <div class="container mt-4">
                        <div class="row d-flex justify-content-center mt-2">
                            <div class="col-6 mb-4">
                                <div class="card color-custom-1" style="height: 200px">
                                    <div class="card-body text-center">
                                        <p class="m-0 fw-bold fs-5">Public</p>
                                        <p class="m-0 note-count fs-5 mt-2"><?php echo $averageRating; ?>/5</p>
                                        <div class="d-flex justify-content-center my-2">
                                            <?php
                                            $a = $partie_decimale > 0 ? '1' : '0';
                                            for ($i = $a; $i < $averageRating; $i++) {
                                                echo '<i class="bi bi-star-fill"></i>';
                                            }
                                            if ($partie_decimale > 0) {
                                                echo '<i class="bi bi-star-half"></i>';
                                            }
                                            for ($i = $a; $i < (5 - $averageRating); $i++) {
                                                echo '<i class="bi bi-star"></i>';
                                            }
                                            ?>
                                        </div>
                                        <p class="mb-0 text-center"><?php echo $rep4['numVotes']; ?> notes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="card color-custom-1" style="height: 200px">
                                    <div class="card-body text-center">
                                        <p class="m-0 fw-bold fs-5">Mes amis</p>
                                        <p class="m-0 note-count fs-5 mt-2">--</p>
                                        <div class="d-flex justify-content-center my-2">
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                        <p class="mb-0 text-center"> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="card color-custom-1" style="height: 200px">
                                    <div class="card-body text-center">
                                        <p class="m-0 fw-bold fs-5">Ma note</p>
                                        <p class="m-0 note-count fs-5 mt-2" id="my-rating">--</p>
                                        <div class="d-flex justify-content-center my-2" id="my-stars-rating">
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                        <p class="mb-0"> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-3">
                <div id="no-connected" class="row justify-content-center">
                    <div class="col-md-3 col-sm-6 d-flex justify-content-center align-items-center border border-dark color-custom-1 menu-oeuvre" data-bs-toggle="modal" data-bs-target="#rateModal">
                        <p class="m-0">NOTER :</p>
                        <i class="bi bi-star ms-2 ms-md-4"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                    <div class="col-md-3 col-sm-6 d-flex justify-content-center align-items-center border border-dark color-custom-1 menu-oeuvre" data-bs-toggle="modal" data-bs-target="#commentModal">
                        <p class="m-0">Rédiger/Modifier ma critique</p>
                        <i class="bi bi-chat-left-dots ms-2 ms-md-3"></i>
                    </div>
                    <div class="col-md-3 col-sm-6 d-flex justify-content-center align-items-center border border-dark color-custom-1 menu-oeuvre" data-bs-toggle="modal" data-bs-target="#addMovieToListModal">
                        <p class="m-0">Ajouter à une liste</p>
                        <i class="bi bi-plus-circle ms-2 ms-md-3"></i>
                    </div>
                    <div class="col-md-1 col-sm-6 d-flex justify-content-center align-items-center border border-dark color-custom-1 menu-oeuvre" data-bs-toggle="modal" data-bs-target="#shareMovieModal">
                        <i class="bi bi-share"></i>
                    </div>
                </div>

                <div>
                    <div>
                        <div>
                            <h2 class="m-5">Synopsis & infos</h2>
                            <p class="m-1" id="movie-synopsis"></p>
                        </div>
                        <br>
                        <div><h3 class="m-5">Critiques publiques : (réserver aux utilisateurs inscrit)</h3></div>
                    </div>
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-2 col-md-10 col-sm-10 d-flex justify-content-center align-items-center border border-dark color-custom-1 menu-oeuvre" id="note-cinq">
                            <p class="text fw-bold m-0 ms-3">5/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="col-lg-2 col-md-10 col-sm-10 d-flex justify-content-center align-items-center border border-dark color-custom-1 menu-oeuvre" id="note-quatre">
                            <p class="text fw-bold m-0 ms-3">4/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        <div class="col-lg-2 col-md-10 col-sm-10 d-flex justify-content-center align-items-center border border-dark color-custom-1 menu-oeuvre" id="note-trois">
                            <p class="text fw-bold m-0 ms-3">3/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        <div class="col-lg-2 col-md-10 col-sm-10 d-flex justify-content-center align-items-center border border-dark color-custom-1 menu-oeuvre" id="note-deux">
                            <p class="text fw-bold m-0 ms-3">2/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        <div class="col-lg-2 col-md-10 col-sm-10 d-flex justify-content-center align-items-center border border-dark color-custom-1 menu-oeuvre" id="note-un">
                            <p class="text fw-bold m-0 ms-3">1/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                        </div>

                    </div>
                    <div id="commentaire" class="row justify-content-center mt-2">
                        <div class="col-md-10 border border-dark color-custom-1 menu-oeuvre overflow-auto" style="height: 200px;">
                            <div class="overflow-auto menu-oeuvre-2" id="comments-quatre">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once('../../inc/components/not_connected/footer.php'); ?>
        <script src="../../inc/js/oeuvre.js"></script>
        <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>