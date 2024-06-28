<?php require_once('../../inc/php/access.php'); ?>
<?php require_once('../../inc/php/display_home.php'); ?>
<?php require_once('../../inc/php/affichage_data_user.php'); ?>
<?php require_once('../../inc/php/function_search_user.php'); ?>
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

<body id="connected_home">
    <?php require_once('../../inc/components/connected/header.php'); ?>
    <main>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="card card-profile text-center border-0" style="background-color: transparent;">
                        <div class="card-body">
                            <img src="../../inc/img/user_img/<?php echo htmlspecialchars($rep_data_user1['photo_utilisateur']); ?>" alt="Photo de l'utilisateur" class="mb-3 card-img-top img-fluid rounded-circle">
                            <h4 class="card-title"><?php echo $rep_data_user1['pseudo'] . ' (#' . $rep_data_user1['id_user'] . ')'; ?></h4>
                            <p class="card-text text-start my-0"><?php echo $rep_data_user1['nom'] . ' ' . $rep_data_user1['prenom']; ?></p>
                            <p class="card-text text-start my-0">Inscrit depuis : <?php echo $rep_data_user1['date_inscription']; ?></p>
                            <span class="badge bg-secondary mt-3"><?php echo $rep_data_user2['count(*)']; ?> amis</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="py-3 d-flex justify-content-center">
                        <div class="row w-100">
                            <div class="col-12 border-1">
                                <div class="col-md-12 overflow-auto menu-oeuvre-2" style="max-height: 500px;">

                                    <h3 class="mb-3">Mes demandes envoyées :</h3>
                                    <table class="table table-striped table-sm border border-1 border-dark">
                                        <tbody>
                                            <?php foreach ($rep3 as $rep3) { ?>
                                                <tr>
                                                    <td class="table-cell"><?php echo htmlspecialchars($rep3['pseudo']) . ' - ' . htmlspecialchars($rep3['nom']) . ' ' . htmlspecialchars($rep3['prenom']); ?></td>
                                                    <td class="table-cell">le 14/04/2024</td>
                                                    <td class="table-cell text-end">
                                                        <a href="my_friend_list.php?demande=cancel_req&id=<?php echo $rep3['id_user']; ?>" class="btn btn-sm btn-outline-secondary" type="submit" name="envoyer_ami">Annuler</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <h3 class="mb-3">Mes demandes reçues :</h3>
                                    <table class="table table-striped table-sm border border-1 border-dark">
                                        <tbody>
                                            <?php foreach ($rep2 as $rep) { ?>
                                                <tr>
                                                    <td class="table-cell"><?php echo htmlspecialchars($rep['pseudo']) . ' - ' . htmlspecialchars($rep['nom']) . ' ' . htmlspecialchars($rep['prenom']); ?></td>
                                                    <td class="table-cell">le 14/04/2024</td>
                                                    <td class="table-cell text-end">
                                                        <form action="my_friend_list.php" method="get" style="display: inline;">
                                                            <input type="hidden" name="demande" value="be_friend">
                                                            <input type="hidden" name="id" value="<?php echo $rep['id_user']; ?>">
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary" name="envoyer_ami">Accepter</button>
                                                        </form>
                                                        <form action="my_friend_list.php" method="get" style="display: inline;">
                                                            <input type="hidden" name="demande" value="cancel_req_from_receiver">
                                                            <input type="hidden" name="id" value="<?php echo $rep['id_user']; ?>">
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary" name="envoyer_ami">Refuser</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="featurette-divider my-4">

                <h3 class="text-center">Listes : </h3>
                <div class="col-md-12 overflow-auto menu-oeuvre-2">
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            try {
                                $req = $bdd->prepare('SELECT nom, id_liste FROM listes WHERE id_user = :id_user AND statut != "invisible"');
                                $req->bindParam(":id_user", $_SESSION['id_user']);
                                $req->execute();

                                $res = $req->fetchAll();

                                foreach ($res as $liste) {
                                    echo '<tr>
                                                <td class="table-cell" scope="row">' . $liste['nom'] . '</td>
                                                <td class="table-cell text-end"><a href="private_list.php?id_liste=' . $liste['id_liste'] . '" class="btn btn-sm btn-outline-secondary">En voir plus</a></td>
                                        </tr>';
                                }
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="container text-center">
                    <a href="./new_list.php" class="nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3 px-5 mb-3">+ créer une nouvelle liste</a>
                </div>
                <hr class="featurette-divider my-2">
                <h1 class="text-center mt-3">Nouveautés</h1>
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <?php $active = true; foreach($res_nouveaute as $film) { ?>
                        <div class="carousel-item <?php if ($active) {echo 'active'; $active = false;} ?>">
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
                                        <button class="nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto">En voir plus</button>
                                    </div>
                                    <div class="w-50" style="background-color: #5956CA;"></div>
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
                            <div class="col-lg-3 border border-dark border-2 text-center rounded-2" style="height: 350px; background-color: #CFDBD5;">
                                <h2 class="mt-5"><?php echo $liste['nom']; ?></h2>
                                <p class="text-start mb-4">De <?php echo $liste['pseudo']; ?><br>Détails : <?php echo $liste['details']; ?></p>
                                <a href="./private_list.php?id_liste=<?php echo $liste['id_liste']; ?>" class="nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3">En voir plus</a>
                            </div>
                        <?php } ?>
                        <button class="w-75 nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3 m-auto mt-4 d-flex justify-content-center" onclick="window.location='public_list.php'">Voir plus de listes</button>
                    </div>
                </div>

                <div class="container marketing">
                    <hr class="featurette-divider">
                    <h1 class="text-center mb-5">Films populaires du moment</h1>
                    <div class="row featurette">
                        <div class="col-md-7">
                            <h2 class="featurette-heading"><?php echo $res_populaires[0]['primaryTitle']; ?></h2>
                            <p class="lead mb-4">De <?php echo $res_populaires[0]['name']; ?><br><?php echo $res_populaires[0]['genre']; ?><br>Sortie en <?php echo $res_populaires[0]['startYear']; ?><br>Résumé : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a gasz jaeal.</p>
                            <button class="nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto">En voir plus</button>
                        </div>
                        <div class="col-md-5">
                            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <rect width="100%" height="100%" fill="#5956CA" />
                            </svg>
                        </div>
                    </div>
                    <hr class="featurette-divider">
                    <div class="row featurette">
                        <div class="col-md-7 order-md-2">
                            <h2 class="featurette-heading"><?php echo $res_populaires[1]['primaryTitle']; ?></h2>
                            <p class="lead mb-4">De <?php echo $res_populaires[1]['name']; ?><br><?php echo $res_populaires[1]['genre']; ?><br>Sortie en <?php echo $res_populaires[1]['startYear']; ?><br>Résumé : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a gasz jaeal.</p>
                            <button class="nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto">En voir plus</button>
                        </div>
                        <div class="col-md-5 order-md-1">
                            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <rect width="100%" height="100%" fill="#5956CA" />
                            </svg>
                        </div>
                    </div>
                    <hr class="featurette-divider">
                    <div class="row featurette mb-5">
                        <div class="col-md-7">
                            <h2 class="featurette-heading"><?php echo $res_populaires[2]['primaryTitle']; ?></h2>
                            <p class="lead mb-4">De <?php echo $res_populaires[2]['name'] ?><br><?php echo $res_populaires[2]['genre']; ?><br>Sortie en <?php echo $res_populaires[1]['startYear']; ?><br>Résumé : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a gasz jaeal.</p>
                            <button class="nav-btn btn btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto">En voir plus</button>
                        </div>
                        <div class="col-md-5">
                            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <rect width="100%" height="100%" fill="#5956CA" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once('../../inc/components/connected/footer.php'); ?>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>