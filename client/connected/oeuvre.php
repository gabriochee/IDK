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
    <?php require_once('../../inc/components/connected/header.php'); ?>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="row col-12 col-lg-6 img-fluid img-custom-1 ">
                    <img src="../../inc/img/test.jpeg" id="movie-poster" alt="affiche de l'oeuvre">
                </div>
                <div class="col-12 col-lg-5">
                    <div>
                        <h1 class="m-1 mb-3" id="movie-title"><?php echo $rep1['primaryTitle']; ?></h1>
                        <p class="m-1" id="movie-year">Durée : <?php echo $rep1['runtimeMinutes']; ?> minutes</p>
                        <p class="m-1">Date de sortie : <?php echo $rep1['startYear']; ?></p>
                        <p class="m-1">Genres : <?php foreach ($rep3 as $genre) {
                                                    echo $genre['genre'] . ((end($rep3) != $genre) ? ", " : "");
                                                } ?></p>
                        <p class="m-1">Acteurs principaux : <?php foreach ($rep5 as $acteur) {
                                                                echo $acteur["name"] . ((end($rep5) != $acteur) ? ", " : "");
                                                            } ?></p>
                        <p class="m-1">Réalisateur : <?php foreach ($rep6 as $realisateur) {
                                                            echo $realisateur["name"] . ((end($rep6) != $realisateur) ? ", " : "");
                                                        } ?></p>
                        <p class="m-1">Producteur : <?php foreach ($rep7 as $producteur) {
                                                        echo $producteur["name"] . ((end($rep7) != $producteur) ? ", " : "");
                                                    } ?></p>
                    </div>
                    <div class="container mt-4">
                        <div class="d-flex justify-content-center mt-2">
                            <div class="card col-1 mx-1 p-3 color-custom-1" style="width: 170px;">
                                <div class="card-body d-flex flex-column justify-content-start align-items-center p-0">
                                    <p class="m-0 fw-bold fs-5">Public</p>
                                    <p class="m-0 note-count fs-5 mt-2"><?php echo $averageRating; ?>/5</p>
                                    <div class="d-flex justify-content-center my-2">
<<<<<<< HEAD
                                        <?php 
                                        $a = $partie_decimale > 0 ? '1' : '0';
                                        for ($i = $a; $i < $averageRating; $i++) {
=======
                                        <?php
                                        for ($i = 1; $i < $averageRating; $i++) {
>>>>>>> d7af768f91d26c98e404c01bf5e335036e47c33a
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
                    <div class="col-3 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre" data-bs-toggle="modal" data-bs-target="#rateModal">
                        <p class="text fw-bold m-0">NOTER :</p>
                        <i class="bi bi-star ms-4"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </div>

                    <div class="modal fade" id="rateModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Noter cette oeuvre</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center gap-4">
                                    <i class="bi bi-star h1" id="rate-1"></i>
                                    <i class="bi bi-star h1" id="rate-2"></i>
                                    <i class="bi bi-star h1" id="rate-3"></i>
                                    <i class="bi bi-star h1" id="rate-4"></i>
                                    <i class="bi bi-star h1" id="rate-5"></i>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
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
                                    
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="commentaire-quatre" class="row justify-content-center">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2">
                                <div>
                                    
                                </div>
                                <div>
                                    
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

                    <form id="myComment">
                        <div data-mdb-input-init class="form-outline my-3">
                            <textarea class="form-control" id="commentText" rows="4" name="commentText"></textarea>
                            <label for="selection">Mets une note:</label>

                            <button class="star-button p-0" id="bouton0">
                                <i class="bi bi-star-fill py-0 my-0"></i>
                                <p class="py-0 my-0">0</p>
                            </button>
                            <button class="star-button" id="bouton1">
                                <i class="bi bi-star-fill py-0 my-0"></i>
                                <p class="py-0 my-0">1</p>
                            </button>
                            <button class="star-button" id="bouton2">
                                <i class="bi bi-star-fill py-0 my-0"></i>
                                <p class="py-0 my-0">2</p>
                            </button>
                            <button class="star-button" id="bouton3">
                                <i class="bi bi-star-fill py-0 my-0"></i>
                                <p class="py-0 my-0">3</p>
                            </button>
                            <button class="star-button" id="bouton4">
                                <i class="bi bi-star-fill py-0 my-0"></i>
                                <p class="py-0 my-0">4</p>
                            </button>
                            <button class="star-button" id="bouton5">
                                <i class="bi bi-star-fill py-0 my-0"></i>
                                <p class="py-0 my-0">5</p>
                            </button>

                            <input type="radio" class="btn-check" name="list-status" id="private-comment" value="privee" autocomplete="off" checked>
                            <label class="btn" for="private-comment">privée</label>

                            <input type="radio" class="btn-check" name="list-status" id="only-friends-comment" value="amis seulement" autocomplete="off">
                            <label class="btn" for="only-friends-comment">amis seulement</label>

                            <input type="radio" class="btn-check" name="list-status" id="public-comment" value="publique" autocomplete="off">
                            <label class="btn" for="public-comment">publique</label>
                        </div>
                        <button class="w-100 btn btn-secondary btn-warning border-dark mt-2" type="submit" data-mdb-button-init data-mdb-ripple-init name="send_comment">Envoyer</button>
                    </form>
                    
                    
                    

                </div>
            </div>
        </div>

        <?php require_once('../../inc/components/connected/footer.php'); ?>
        <script src="../../inc/js/oeuvre.js"></script>
        <script src="../../inc/js/search_movie.js"></script>
        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var privee = document.getElementById("private-comment");
                            var ami = document.getElementById("only-friends-comment");
                            var publique = document.getElementById("public-comment");

                            var buttons = [
                                document.getElementById("bouton0"),
                                document.getElementById("bouton1"),
                                document.getElementById("bouton2"),
                                document.getElementById("bouton3"),
                                document.getElementById("bouton4"),
                                document.getElementById("bouton5")
                            ];

                            var selectedNote = -1; // stocker la note sélectionnée -1 = aucune sélection
                            var selectedStatut = privee.value; // par défaut la valeur sélectionnée est 'privee'

                            // Recup note
                            buttons.forEach(function(button, index) {
                                button.addEventListener("click", function(event) {
                                    event.preventDefault();
                                    selectNote(index);
                                });
                            });

                            function selectNote(note) {
                                selectedNote = note;
                                updateSelectedStyle(note);
                            }

                            // Recup statut
                            privee.addEventListener("change", function(event) {
                                selectStatut(privee);
                            });

                            ami.addEventListener("change", function(event) {
                                selectStatut(ami);
                            });

                            publique.addEventListener("change", function(event) {
                                selectStatut(publique);
                            });

                            function selectStatut(statutElement) {
                                selectedStatut = statutElement.value;
                            }

                            function updateSelectedStyle(note) {
                                buttons.forEach(function(button) {
                                    button.style.opacity = "0.5";
                                });

                                if (note >= 0 && note < buttons.length) {
                                    buttons[note].style.opacity = "1";
                                }
                            }

                            document.getElementById("myComment").addEventListener("submit", function(event) {
                                event.preventDefault();

                                var currentUrl = window.location.href;
                                var urlParams = new URLSearchParams(window.location.search);
                                var idMovie = urlParams.get('mv');

                                var commentText = document.getElementById('commentText').value;

                                fetch('../../inc/php/send_comment.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        comment: commentText,
                                        note: selectedNote,
                                        statut: selectedStatut,
                                        idMovie: idMovie
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        // Vider
                                        document.getElementById('commentText').value = "";
                                        alert("Message envoyé avec succès !");
                                        // Remettre en pas de note
                                        selectedNote = -1;
                                        updateSelectedStyle(selectedNote);
                                    } else {
                                        alert("Er du message : " + data.error);
                                    }
                                })
                                .catch(error => {
                                    alert("Erreur lors u message : " + error.message);
                                });
                            });
                        });
                    </script>
        <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>