<?php 
session_start();


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
<body id="oeuvre">
    <?php require_once('../../inc/php/db.php'); ?>
    <?php require_once('../../inc/php/function_oeuvre.php'); ?>    
    <?php require_once('../../inc/components/connected/header.php'); ?>  
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="row col-12 col-lg-6 img-fluid img-custom-1 " >
                    <img src="../../inc/img/test.jpeg" id="movie-poster" alt="affiche de l'oeuvre">
                </div>
                <div class="col-12 col-lg-5">
                    <div>
                        <h1 class="m-1 mb-3" id="movie-title"><?php echo $rep1['primaryTitle']; ?></h1>
                        <p class="m-1" id="movie-year">Durée : <?php echo $rep1['runtimeMinutes']; ?> minutes</p>
                        <p class="m-1">Date de sortie : <?php echo $rep1['startYear']; ?></p>
                        <p class="m-1">Genres : <?php foreach($rep3 as $genre){ echo $genre['genre'] . ((end($rep3) != $genre) ? ", " : "");} ?></p>
                        <p class="m-1">Acteurs principaux : <?php foreach($rep5 as $acteur){ echo $acteur["name"] . ((end($rep5) != $acteur) ? ", " : "");}?></p>
                        <p class="m-1">Réalisateur : <?php foreach($rep6 as $realisateur){ echo $realisateur["name"] . ((end($rep6) != $realisateur) ? ", " : "");}?></p>
                        <p class="m-1">Producteur : <?php foreach($rep7 as $producteur){ echo $producteur["name"] . ((end($rep7) != $producteur) ? ", " : "");}?></p>  
                    </div>
                    <div class ="container mt-4">
                        <div class="d-flex justify-content-center mt-2">
                            <div class="card col-1 mx-1 p-3 color-custom-1" style="width: 170px;">
                                <div class="card-body d-flex flex-column justify-content-start align-items-center p-0">
                                    <p class="m-0 fw-bold fs-5">Public</p>
                                    <p class="m-0 note-count fs-5 mt-2"><?php echo $averageRating; ?></p>
                                    <div class="d-flex justify-content-center my-2">
                                        <?php 
                                        for ($i = 1; $i < $averageRating; $i++) {
                                            echo '<i class="bi bi-star-fill"></i>';
                                        }
                                        if ($partie_decimale > 0) {
                                            echo '<i class="bi bi-star-half"></i>';
                                        }
                                        for ($i = 1; $i < (5 - $averageRating); $i++) {
                                            echo '<i class="bi bi-star"></i>';
                                        }
                                        ?>
                                    </div>
                                    <p class="mb-0 text-center"><?php echo $rep4['numVotes']; ?> notes<br>2 critiques</p>
                                </div>
                            </div>
                            <div class="card col-1 mx-1 p-3 color-custom-1" style="width: 170px;">
                                <div class="card-body d-flex flex-column justify-content-start align-items-center p-0">
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
                            <div class="card col-1 mx-1 p-3 color-custom-1" style="width: 170px;">
                                <div class="card-body d-flex flex-column justify-content-start align-items-center p-0">
                                    <p class="m-0 fw-bold fs-5">Ma note</p>
                                    <p class="m-0 note-count fs-5 mt-2">--</p>
                                    <div class="d-flex justify-content-center my-2">
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
            <div class="container mt-3">
                <div id="connected" class="row justify-content-center">
                    <div class="col-3 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre">
                        <p class="text fw-bold m-0">NOTER :</p>
                        <i class="bi bi-star ms-4"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre">
                        <p class="m-0">Rédiger/Modifier ma critique</p>
                        <i class="bi bi-chat-left-dots ms-3"></i>
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre">
                        <p class="m-0">Ajouter à une liste</p>
                        <i class="bi bi-plus-circle ms-3"></i>
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center border border-2 border-dark color-custom-1 menu-oeuvre">
                        <i class="bi bi-share"></i>
                    </div>
                </div>
                <div>
                    <div>
                        <div>
                            <h2 class="m-5">Synopsis & infos</h2>
                            <p id="movie-synopsis"></p>
                        </div>
                        <br>
                        <h3 class="m-3">Critiques publiques :</h3>
                    </div>
                    <div class="row justify-content-center mt-5">
                        <div class="col-2 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre" id="note-cinq">
                            <p class="text fw-bold m-0 ms-3">5/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre" id="note-quatre">
                            <p class="text fw-bold m-0 ms-3">4/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre" id="note-trois">
                            <p class="text fw-bold m-0 ms-3">3/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre" id="note-deux">
                            <p class="text fw-bold m-0 ms-3">2/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre" id="note-un">
                            <p class="text fw-bold m-0 ms-3">1/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center border border-2 border-dark color-custom-1 menu-oeuvre" id="note-zero">
                            <p class="text fw-bold m-0 ms-3">0/5</p>
                            <i class="bi bi-star ms-3"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                        </div>
                    </div>
                    <div id="commentaire-cinq" class="row justify-content-center">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2">
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 5/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 5/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                            </div>
                        </div>           
                    </div>
                    <div id="commentaire-quatre" class="row justify-content-center">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2">
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 4/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 4/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 4/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                            </div>
                        </div>           
                    </div>
                    <div id="commentaire-trois" class="row justify-content-center">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2">
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 3/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 3/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 3/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                            </div>
                        </div>           
                    </div>
                    <div id="commentaire-deux" class="row justify-content-center">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2">
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 2/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 2/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 2/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                            </div>
                        </div>           
                    </div>
                    <div id="commentaire-un" class="row justify-content-center">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2">
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 1/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 1/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 1/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                            </div>
                        </div>           
                    </div>
                    <div id="commentaire-zero" class="row justify-content-center">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2">
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 0/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 0/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                                <div>
                                    <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 0/5</p>
                                    <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                </div>
                            </div>
                        </div>           
                    </div>
                </div>
            </div>
        </div>
                    
    <?php require_once('../../inc/components/connected/footer.php'); ?>          
    <script src="../../inc/js/oeuvre.js"></script>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>