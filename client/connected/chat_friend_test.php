<?php 
session_start();


?>
<?php require_once('../../inc/php/function_chat_friend.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/style/style.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body>
    <?php require_once('../../inc/connected/header.php'); ?>
    <h1 class="text-center my-5">Chat with your Friend</h1>
    <section style="background-color: #E8EDDF;">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                    <h5 class="font-weight-bold mb-3 text-center text-lg-start">My Friend</h5>
                    <div class="container mt-5">
                        <div class="row" id="friendsList">
                            <!-- les Cards -->
                        </div>   
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-8">
                    <h5 class="font-weight-bold mb-3 text-center" id="friend-name">le nom de la personne</h5>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Brad Pitt</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 10 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <form id="messageForm">
                            <div class="form-group">
                                <label for="messageText">Message</label>
                                <textarea class="form-control" id="messageText" rows="3" maxlength="11" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <?php require_once('../../inc/connected/footer.php'); ?>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../inc/js/chat_friend.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof friendData !== 'undefined') {
                let listFriend = document.getElementById('friendsList');
                friendData.forEach(function(friend) {
                    let listItem = document.createElement('div');
                    listItem.className = 'col-12 mb-2';
                    listItem.innerHTML = `
                        <div class="card p-2">
                            <a href="#!" onclick="selectFriend(${friend.id_user}, '${friend.pseudo}')" class="d-flex justify-content-between">
                                <div class="d-flex flex-row">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp" alt="avatar" class="rounded-circle me-3 shadow-1-strong" width="60">
                                    <div class="pt-1">
                                        <p class="fw-bold mb-0">${friend.pseudo}</p>
                                        <p class="small text-muted">${friend.prenom} ${friend.nom}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    `;
                    listFriend.appendChild(listItem);
                });
            }
        });

        let selectedFriendId = null;

        function selectFriend(friendId, friendPseudo) {
            selectedFriendId = friendId;
            document.getElementById('friend-name').innerText = friendPseudo;
        }

        document.getElementById('myForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêcher le rechargement de la page 

        let textFieldValue = document.getElementById('myTextField').value;

        fetch('http://localhost/Projet_annuel/IDK-2/inc/php/function_chat_friend.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ myTextField: textFieldValue })
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        });

    </script>
</body>
</html>

