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
                                    <p class="mb-0 text-center"><?php echo $rep4['numVotes']; ?> notes<br>2 critiques</p>
                                </div>
                            </div>
                            <div class="card col-1 mx-1 p-3 color-custom-1" style="width: 170px;">
                                <div class="card-body d-flex flex-column justify-content-start align-items-center p-0">
                                    <p class="m-0 fw-bold fs-5">Mes amis</p>
                                    <p class="m-0 note-count fs-5 mt-2"><?php if ($rep9 && $rep9['COUNT(id_user)'] > 0) {
                                                                            echo $myFriendsRating;
                                                                        } else {
                                                                            echo '--';
                                                                        } ?></p>
                                    <div class="d-flex justify-content-center my-2" id="my-stars-rating">
                                        <?php
                                        if ($rep9) {
                                            $a = $myFriendsPartie_decimale > 0 ? '1' : '0';
                                            for ($i = $a; $i < $myFriendsRating; $i++) {
                                                echo '<i class="bi bi-star-fill"></i>';
                                            }
                                            if ($myFriendsPartie_decimale > 0) {
                                                echo '<i class="bi bi-star-half"></i>';
                                            }
                                            for ($i = $a; $i < (5 - $myFriendsRating); $i++) {
                                                echo '<i class="bi bi-star"></i>';
                                            }
                                        } else {
                                            for ($i = 0; $i < 5; $i++) {
                                                echo '<i class="bi bi-star"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <p class="mb-0 text-center"> </p>
                                </div>
                            </div>
                            <div class="card col-1 mx-1 p-3 color-custom-1" style="width: 170px;">
                                <div class="card-body d-flex flex-column justify-content-start align-items-center p-0">
                                    <p class="m-0 fw-bold fs-5">Ma note</p>
                                    <p class="m-0 note-count fs-5 mt-2" id="my-rating"><?php if ($rep8) {
                                                                            echo $myRating;
                                                                        } else {
                                                                            echo '--';
                                                                        } ?></p>
                                    <div class="d-flex justify-content-center my-2" id="my-stars-rating">
                                        <?php
                                        if ($rep8) {
                                            $a = $myPartie_decimale > 0 ? '1' : '0';
                                            for ($i = $a; $i < $myRating; $i++) {
                                                echo '<i class="bi bi-star-fill"></i>';
                                            }
                                            if ($myPartie_decimale > 0) {
                                                echo '<i class="bi bi-star-half"></i>';
                                            }
                                            for ($i = $a; $i < (5 - $myRating); $i++) {
                                                echo '<i class="bi bi-star"></i>';
                                            }
                                        } else {
                                            for ($i = 0; $i < 5; $i++) {
                                                echo '<i class="bi bi-star"></i>';
                                            }
                                        }
                                        ?>
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

                    <div class="col-3 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre" data-bs-toggle="modal" data-bs-target="#commentModal">
                        <p class="m-0">Rédiger/Modifier ma critique</p>
                        <i class="bi bi-chat-left-dots ms-3"></i>
                    </div>

                    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commentModalLabel">Rédiger/Modifier ma critique</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div id="existingComment" class="mb-3">
                                    <?php if (!empty($recup_my_comment) && isset($recup_my_comment['statut'])) : ?>
                                        <h6>Statut de visibilité: <?php echo htmlspecialchars($recup_my_comment['statut']); ?></h6>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($recup_my_comment) && isset($recup_my_comment['critique'])) : ?>
                                        <h6>Mon commentaire :</h6>
                                        <p><?php echo nl2br(htmlspecialchars($recup_my_comment['critique'])); ?></p>
                                    <?php endif; ?>
                                </div>

                                    <form id="myComment" onsubmit="submitForm(event);">
                                        <div data-mdb-input-init class="form-outline my-3">
                                            <textarea class="form-control" id="commentText" rows="4" name="commentText"></textarea>
                                            <div class="container d-flex justify-content-center mt-3">
                                                <input type="radio" class="btn-check" name="list-status" id="private-list" value="privee" autocomplete="off" <?php if (isset($statut) && ($statut == 'privee')) { echo 'checked'; } ?>>
                                                <label class="btn" for="private-list">privée</label>
                                                <input type="radio" class="btn-check" name="list-status" id="only-friends-list" value="amis seulement" autocomplete="off" <?php if (isset($statut) && ($statut == 'amis seulement')) { echo 'checked';} ?>>
                                                <label class="btn" for="only-friends-list">amis seulement</label>
                                                <input type="radio" class="btn-check" name="list-status" id="public-list" value="publique" autocomplete="off" <?php if (isset($statut) && ($statut == 'publique')) { echo 'checked';} ?>>
                                                <label class="btn" for="public-list">publique</label>
                                            </div>
                                        </div>
                                        <button class="w-100 btn btn-secondary btn-warning border-dark mt-2" type="submit" data-mdb-button-init data-mdb-ripple-init name="send_comment">Envoyer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-flex justify-content-center align-items-center border border-2 border-end-0 border-dark color-custom-1 menu-oeuvre" data-bs-toggle="modal" data-bs-target="#addMovieToListModal">
                        <p class="m-0">Ajouter à une liste</p>
                        <i class="bi bi-plus-circle ms-3"></i>
                    </div>

                    <div class="modal fade" id="addMovieToListModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Ajouter ce film à votre liste</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex flex-column justify-content-start">
                                    <label for="search-list-input" class="form-label text-start">Rechercher</label>
                                    <input type="search" class="form-control mb-2" id="search-list-input" onkeydown="searchMyLists(this, this.value)">
                                    <div class="container d-flex flex-column form-check" id="lists-result-container">

                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-1 d-flex justify-content-center align-items-center border border-2 border-dark color-custom-1 menu-oeuvre">
                        <i class="bi bi-share" data-bs-toggle="modal" data-bs-target="#shareMovieModal"></i>

                        <div class="modal fade" id="shareMovieModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Partager ce film</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column justify-content-start">
                                        <label for="share-comment" class="form-label text-start">Votre message</label>
                                        <textarea class="form-control" id="share-comment" name="share-comment"></textarea>
                                        <hr>
                                        <label for="search-friend-input" class="form-label text-start">Rechercher un ami</label>
                                        <input type="search" class="form-control mb-2" id="search-friend-input" onkeydown="searchFriend()">
                                        <div class="container d-flex flex-column form-check" id="friends-result-container">

                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                        <div class="col-2 d-flex justify-content-center align-items-center border border-2 border-dark color-custom-1 menu-oeuvre" id="note-un">
                            <p class="text fw-bold m-0 ms-3">1/5</p>
                            <i class="bi bi-star-fill ms-3"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        
                    </div>

                    
                    <div id="commentaire" class="row justify-content-center" style="display;">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2" id="comments-quatre">

                            </div>
                        </div>
                    </div>
                    

                    


                </div>
            </div>
        </div>

        <?php require_once('../../inc/components/connected/footer.php'); ?>
        <script src="../../inc/js/oeuvre.js"></script>
        <script src="../../inc/js/add_movie_to_my_lists.js"></script>
        <script>
            function submitForm(event) {
                event.preventDefault();

                var commentModal = document.getElementById('commentModal');
                var modal = bootstrap.Modal.getInstance(commentModal); 
                modal.hide(); 
            }
            document.addEventListener('DOMContentLoaded', function() {
            var selectedStatut = document.querySelector('input[name="list-status"]:checked').value;

            document.querySelectorAll('input[name="list-status"]').forEach(function(radio) {
                radio.addEventListener('change', function(event) {
                    selectedStatut = event.target.value;
                });
            });

            document.getElementById("myComment").addEventListener("submit", function(event) {
                    event.preventDefault();

                    var currentUrl = window.location.href;
                    var urlParams = new URLSearchParams(window.location.search);
                    var idMovie = urlParams.get('mv');
                    var commentText = document.getElementById('commentText').value;
                    
                    fetch('../../inc/php/send_comment_and_note.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            comment: commentText,
                            statut: selectedStatut,
                            idMovie: idMovie
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            document.getElementById('commentText').value = "";
                            alert("Message envoyé avec succès !");
                        } else {
                            alert("Erreur lors de l'envoi du message : " + data.error);
                        }
                    })
                    .catch(error => {
                        alert("Erreur lors de l'envoi du message : " + error.message);
                    });
                });
            });


            document.addEventListener("DOMContentLoaded", function() {
                const commentsContainer = document.getElementById("comments-quatre");
                let intervalId = null;

                function handleNoteClick(note1, note2) {
                    if (intervalId) {
                        clearInterval(intervalId);
                    }
                    showCommentByNote(note1,note2);
                }

                const noteCinq = document.getElementById("note-cinq");
                if (noteCinq) {
                    noteCinq.addEventListener("click", function() {
                        handleNoteClick(10, 9);
                    });
                }

                const noteQuatre = document.getElementById("note-quatre");
                if (noteQuatre) {
                    noteQuatre.addEventListener("click", function() {
                        handleNoteClick(8, 7);
                    });
                }

                const noteTrois = document.getElementById("note-trois");
                if (noteTrois) {
                    noteTrois.addEventListener("click", function() {
                        handleNoteClick(6, 5);
                    });
                }

                const noteDeux = document.getElementById("note-deux");
                if (noteDeux) {
                    noteDeux.addEventListener("click", function() {
                        handleNoteClick(4, 3);
                    });
                }

                const noteUn = document.getElementById("note-un");
                if (noteUn) {
                    noteUn.addEventListener("click", function() {
                        handleNoteClick(2, 1);
                    });
                }

                function showCommentByNote(note1,note2) {
                    var currentUrl2 = window.location.href;
                    var urlParams2 = new URLSearchParams(window.location.search);
                    var idMovie2 = urlParams2.get('mv');
                    
                    fetch('../../inc/php/function_comment_by_note.php', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            idMovie2: idMovie2,
                            note1: note1,
                            note2: note2
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'error') {
                            console.error(data.message);
                        } else {
                            console.log(data.reviews);

                            commentsContainer.innerHTML = '';

                            data.reviews.forEach(review => {
                                const paragraph = document.createElement('p');
                                paragraph.textContent = `${review.date_avis} - ${review.pseudo} - ${review.critique}`;
                                commentsContainer.appendChild(paragraph);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching reviews:', error);
                    });
                }
            });

        </script>
        <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>