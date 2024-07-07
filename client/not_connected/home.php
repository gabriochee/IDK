<?php require('../../inc/php/access.php'); ?>
<?php require('../../inc/php/display_home.php'); ?>
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

<body id="not_connected_home">
    <?php require('../../inc/components/not_connected/header.php'); ?>
    <main>
        <div class="container mt-5 mb-5">
            <div class="container text-center m-auto">
                <div class="row">
                    <div class="col-lg-6 m-auto p-4">
                        <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid mb-5" width="150px" height="150px">
                        <h1 class="mb-5">La plateforme qui vous comprend.</h1>
                        <p class="mb-5">IDK simplifie la recherche de divertissements en recommandant des films personnalisés, basés sur vos préférences uniques et vos habitudes de visionnage.</p>
                        <form method="" action="questionnaire.php"><button class="nav-btn btn btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 mb-5">Commencer le questionnaire</button></form>
                    </div>
                </div>
            </div>

            <div class="container marketing">
                <div class="row d-flex justify-content-around mb-5">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card border-dark border-2 text-center h-100 rounded-2" style="background-color: #CFDBD5;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h2 class="card-title mt-3">Un réseau de film qui évolue avec tous</h2>
                                <p class="card-text mt-4">IDK apprends de vos choix pour affiner vos suggestions et vous offrir une expérience toujours plus personnalisé avec vos amis.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card border-dark border-2 text-center h-100 rounded-2" style="background-color: #CFDBD5;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h2 class="card-title mt-3">Un contrôle total sur vos listes</h2>
                                <p class="card-text mt-4">Personnaliser votre univers cinéphile en toute intimité :<br>Partagez des listes sur mesure en désélectionnant ce que vous souhaitez garder secret.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card border-dark border-2 text-center h-100 rounded-2" style="background-color: #CFDBD5;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h2 class="card-title mt-3">Votre ami et vous êtes en désaccord ?</h2>
                                <p class="card-text mt-4">Utilisez nos fonctionnalités fusion et anti-film. Ces fonctionnalités permettent ou de choisir un film parmis une selection lors ou de sélectionner le film que vous pourriez aimé mais qui est peu dans vos habitudes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <hr class="featurette-divider my-2">
            <h1 class="text-center mt-3">Nouveauté</h1>
            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <?php $active = true;
                    foreach ($res_nouveaute as $film) { ?>
                        <div class="carousel-item <?php if ($active) {
                                                        echo 'active';
                                                        $active = false;
                                                    } ?>">
                            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <rect width="100%" height="100%" fill="#E8EDDF" />
                            </svg>
                            <div class="container">
                                <div class="carousel-caption text-start text-dark d-flex">
                                    <div class="w-50">
                                        <h1><br><?php echo $film['primaryTitle']; ?></h1>
                                        <p><br><br>De <?php echo $film['name']; ?><br><?php if (isset($film['genre'])) {
                                                                                            echo $film['genre'];
                                                                                        } ?><br>Sortie en <?php echo $film['startYear']; ?><br><br><br></p>
                                        <a href="oeuvre.php?mv=<?php echo $film['id_work']; ?>" class="nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3 m-auto">En voir plus</a>
                                    </div>
                                    <div class="w-50 d-flex justify-content-center" style="background-color: #E8EDDF;">
                                        <img class="movie-poster" movie-title="<?php echo $film['primaryTitle']; ?>" movie-year="<?php echo $film['startYear']; ?>" src="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="container marketing">
                <h1 class="text-center mb-5">Listes les plus populaires</h1>
                <div class="row d-flex justify-content-around">
                    <?php foreach ($res_listes_populaires as $liste) { ?>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                            <div class="card border-dark border-2 text-center h-100 rounded-2" style="background-color: #CFDBD5;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h2 class="card-title mt-3"><?php echo $liste['nom']; ?></h2>
                                    <p class="card-text text-start">De <?php echo $liste['pseudo']; ?><br>Détails : <?php echo $liste['details']; ?></p>
                                    <a href="./private_list.php?id_liste=<?php echo $liste['id_liste']; ?>" class="btn btn-lg btn-warning text-white border border-light border-2 rounded-3 mt-auto">En voir plus</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="w-75 btn btn-lg btn-warning text-white border border-light border-2 rounded-3" onclick="window.location='public_list.php'">Voir plus de listes</button>
                </div>
            </div>

            <div class="container marketing">
                <hr class="featurette-divider">
                <h1 class="text-center mb-5">Films populaires du moment</h1>
                <div class="row featurette">
                    <div class="col-md-7 mb-2">
                        <h2 class="featurette-heading"><?php echo $res_populaires[0]['primaryTitle']; ?></h2>
                        <p class="lead mb-4">De <?php echo $res_populaires[0]['name']; ?><br><?php echo $res_populaires[0]['genre']; ?><br>Sortie en <?php echo $res_populaires[0]['startYear']; ?><br><span class="resume"></span></p>
                        <a href="oeuvre.php?mv=<?php echo $res_populaires[0]['id_work']; ?>" class="nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3 m-auto">En voir plus</a>
                    </div>
                    <div class="col-md-5">
                        <img class="movie-poster" movie-title="<?php echo $res_populaires[0]['primaryTitle']; ?>" movie-year="<?php echo $res_populaires[0]['startYear']; ?>" src="">
                    </div>
                </div>
                <hr class="featurette-divider">
                <div class="row featurette">
                    <div class="col-md-7 order-md-2 mb-2">
                        <h2 class="featurette-heading"><?php echo $res_populaires[1]['primaryTitle']; ?></h2>
                        <p class="lead mb-4">De <?php echo $res_populaires[1]['name']; ?><br><?php echo $res_populaires[1]['genre']; ?><br>Sortie en <?php echo $res_populaires[1]['startYear']; ?><br><span class="resume"></span></p>
                        <a href="oeuvre.php?mv=<?php echo $res_populaires[1]['id_work']; ?>" class="nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3 m-auto">En voir plus</a>
                    </div>
                    <div class="col-md-5 order-md-1">
                        <img class="movie-poster" movie-title="<?php echo $res_populaires[1]['primaryTitle']; ?>" movie-year="<?php echo $res_populaires[1]['startYear']; ?>" src="">
                    </div>
                </div>
                <hr class="featurette-divider">
                <div class="row featurette mb-5">
                    <div class="col-md-7 mb-2">
                        <h2 class="featurette-heading"><?php echo $res_populaires[2]['primaryTitle']; ?></h2>
                        <p class="lead mb-4">De <?php echo $res_populaires[2]['name'] ?><br><?php echo $res_populaires[2]['genre']; ?><br>Sortie en <?php echo $res_populaires[1]['startYear']; ?><br><span class="resume"></span></p>
                        <a href="oeuvre.php?mv=<?php echo $res_populaires[2]['id_work']; ?>" class="nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3 m-auto">En voir plus</a>
                    </div>
                    <div class="col-md-5">
                        <img class="movie-poster" movie-title="<?php echo $res_populaires[2]['primaryTitle']; ?>" movie-year="<?php echo $res_populaires[2]['startYear']; ?>" src="">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require('../../inc/components/not_connected/footer.php'); ?>
    <script src="../../inc/js/display_home_movies.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>