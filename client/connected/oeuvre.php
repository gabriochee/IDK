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

                    <div id="commentaire-cinq" class="row justify-content-center" style="display: none;">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2" id="comments-cinq">
                                <p>salut5</p>
                            </div>
                        </div>
                    </div>
                    <div id="commentaire-quatre" class="row justify-content-center" style="display: none;">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2" id="comments-quatre">
                                <p>salut4</p>
                            </div>
                        </div>
                    </div>
                    <div id="commentaire-trois" class="row justify-content-center" style="display: none;">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2" id="comments-trois">
                                <p>salut3</p>
                            </div>
                        </div>
                    </div>
                    <div id="commentaire-deux" class="row justify-content-center" style="display: none;">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2" id="comments-deux">
                                <p>salut2</p>
                            </div>
                        </div>
                    </div>
                    <div id="commentaire-un" class="row justify-content-center" style="display: none;">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2" id="comments-un">
                                <p>salut1</p>
                            </div>
                        </div>
                    </div>
                    <div id="commentaire-zero" class="row justify-content-center" style="display: none;">
                        <div class="col-12 border border-2 border-top-0 border-dark color-custom-2">
                            <div class="overflow-auto menu-oeuvre-2" id="comments-zero">
                                <p>salut 0</p>
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














            const cinq = document.getElementById("commentaire-cinq");
            const quatre = document.getElementById("commentaire-quatre");
            const trois = document.getElementById("commentaire-trois");
            const deux = document.getElementById("commentaire-deux");
            const un = document.getElementById("commentaire-un");
            const zero = document.getElementById("commentaire-zero");
            let intervalId = null; 

            const sections = { 5: cinq, 4: quatre, 3: trois, 2: deux, 1: un, 0: zero };

            function handleNoteClick(note) {
                for (const key in sections) {
                    sections[key].style.display = "none";
                }
                sections[note].style.display = "block";
                if (intervalId) {
                clearInterval(intervalId);
                }
                showCommentByNote(note);
            }

            document.getElementById("note-cinq").addEventListener("click", function() {
                alert("5");
                handleNoteClick(5);
            });
            document.getElementById("note-quatre").addEventListener("click", function() {
                alert("4");
                handleNoteClick(4);
            });
            document.getElementById("note-trois").addEventListener("click", function() {
                alert("3");
                handleNoteClick(3);
            });
            document.getElementById("note-deux").addEventListener("click", function() {
                alert("2");
                handleNoteClick(2);
            });
            document.getElementById("note-un").addEventListener("click", function() {
                alert("1");
                handleNoteClick(1);
            });
            document.getElementById("note-zero").addEventListener("click", function() {
                alert("0");
                handleNoteClick(0);
            });

            function showCommentByNote(note) {
                var note = note;
                var currentUrl2 = window.location.href;
                var urlParams2 = new URLSearchParams(window.location.search);
                var idMovie2 = urlParams2.get('mv');
                console.log(idMovie2);

                intervalId = setInterval(() => {
                    
                    const me = <?php echo $_SESSION['id_user']; ?>;

                    fetch('../../inc/php/function_comment_by_note.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ idMovie2: idMovie2, me: me, note: note })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'error') {
                            // 
                        } else {
                            document.querySelector('#message_list').innerHTML = '';
                            data.forEach(message => {
                                const li = document.createElement('li');
                                li.classList.add('d-flex', 'mb-4');
                                const isSender = message.id_user_1 == <?php echo $_SESSION['id_user']; ?>;
                                
                                if (isSender) {
                                    li.classList.add('justify-content-end');
                                } else {
                                    li.classList.add('justify-content-start');
                                }

                                const card = document.createElement('div');
                                card.classList.add('card');

                                if (isSender) {
                                    card.classList.add('text-end', 'text-success');
                                } else {
                                    card.classList.add('text-start', 'text-danger');
                                }

                                const cardHeader = document.createElement('div');
                                cardHeader.classList.add('card-header', 'd-flex', 'justify-content-between', 'p-3');

                                const cardBody = document.createElement('div');
                                cardBody.classList.add('card-body');

                                const messageUser = document.createElement('p');
                                messageUser.textContent = isSender ? 'me' : message.pseudo_other;
                                messageUser.classList.add('pseudo_size');
                                        
                                const messageContent = document.createElement('p');
                                messageContent.classList.add('mb-0');
                                messageContent.textContent = message.contenu_message;
                                
                                const messageDate = document.createElement('p');
                                messageDate.textContent = message.date_messsage;
                                messageDate.classList.add('date_size');

                                cardBody.appendChild(messageUser);
                                cardBody.appendChild(messageContent);
                                cardBody.appendChild(messageDate);
                                
                                card.appendChild(cardBody);
                                li.appendChild(card);

                                document.querySelector('#message_list').appendChild(li);
                            });
                        }
                    })
                    .catch(error => {
                        // 
                    });
                }, 1000); 
            }

            function getWorkIdFromUrl() {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get('work_id');
            }

            function displayComments(note, comments) {
            const commentsContainer = document.getElementById(`comments-${note}`);
            commentsContainer.innerHTML = ''; // Clear existing comments

            comments.forEach(comment => {
                const commentElement = document.createElement('div');
                commentElement.innerHTML = `
                    <p class="m-0 fw-bold fs-5">&#x2022; ${comment.user}, inscrit depuis ${comment.joined}, ${comment.followers} abonnées, ${comment.public_reviews} critiques publiques, ${comment.public_lists} listes publiques, publié le ${comment.date} : ${note}/5</p>
                    <p class="mb-0">${comment.text}</p>
                `;
                commentsContainer.appendChild(commentElement);
            });
            }
        </script>
        <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>