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
    <style>
        .pseudo_size {
            font-size: 0.5em;
        }
        .date_size {
            font-size: 0.5em;
        }
        .message-container {
            max-height: 400px; /* Définissez une hauteur maximale en fonction de vos besoins */
            overflow-y: scroll;
        }
        .custom-no-underline {
         text-decoration: none !important;
        }
    </style>
</head>
<body>
    <?php require_once('../../inc/components/connected/header.php'); ?>
    <?php require_once('../../inc/php/function_chat_friend.php'); ?>
    <div class="col-lg-6 m-auto p-4">
        <h3 class="text-center mt-4">Messagerie</h3>
    </div>
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0 border-end border-2 border-dark">
                    <div class="container mt-5">
                        <div class="row" id="friendsList"></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-8">
                    <h5 class="font-weight-bold mb-3 text-center" id="friend-name"></h5>
                    <div class="message-container">
                        <ul class="list-unstyled">
                            <div class="container mt-5">
                                <div class="row" id="message_list"></div>
                            </div>
                        </ul>
                    </div>
                    <form id="myMessage">
                        <div data-mdb-input-init class="form-outline my-3">
                            <textarea class="form-control" id="messageText" rows="4" name="user_message"></textarea>
                        </div>
                        <button class="w-100 btn btn-secondary btn-warning border-dark mt-2" type="submit" data-mdb-button-init data-mdb-ripple-init name="send_message">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php require_once('../../inc/components/connected/footer.php'); ?>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        let intervalId = null; 
        let currentFriendId = 0; // variable pour stocker l'id de l'utilisateur qu'on a cliqué et qu'on a 
        // fetch mes amis pour que je puisse cliquer et envoyer message à cet amis

        document.addEventListener('DOMContentLoaded', function() {
            if (typeof friendData !== 'undefined') {
                let listFriend = document.getElementById('friendsList');

                friendData.forEach(function(friend) {
                    let listItem = document.createElement('div');
                    listItem.className = 'p-2 border-bottom';
                    listItem.style.backgroundColor = '#eee';
                    listItem.innerHTML = 
                        `<div class="d-flex justify-content-between">
                            <div class="d-flex flex-row">
                                <img src="../../inc/img/profile.svg" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                <div class="pt-1">
                                    <p class="m-0 text-black">${friend.pseudo}</p>
                                    <p class="m-0 text-black">${friend.prenom} ${friend.nom}</p>
                                </div>
                            </div>
                            <div class="pt-1 my-auto">
                                <button type="submit" onclick="fetchFriendConv('${friend.pseudo}', ${friend.id_user})" name="friendDisplay" class="nav-btn btn btn-primary btn-sm btn-warning text-white border border-light border-2 rounded-3">Voir conversation</button>
                                <!--<p class="small text-muted mb-1">Just now</p>-->
                                <!--<span class="badge bg-danger float-end">1</span>-->
                            </div>
                        </div>`;
                    listFriend.appendChild(listItem);
                });
            } else {
                // console.error('friendData n\'est pas défini');
            }
        });

        function fetchFriendConv(pseudo, id_user) {
            console.log("Friend clicked:", pseudo);
            console.log("id of clicked:", id_user);
            
            document.getElementById('friend-name').innerText = pseudo;
            currentFriendId = id_user; // Mise à jour de la variable globale à utiliser pour savoir à qui envoyer

            if (intervalId) {
                clearInterval(intervalId);
            }
            send_id(currentFriendId);
        }

        
        function send_id(currentFriendId) {
            intervalId = setInterval(() => {
                const me = <?php echo $_SESSION['id_user']; ?>;
                fetch('../../inc/php/function_fetch_message.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ currentFriendId: currentFriendId, me: me })
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

        document.getElementById('myMessage').addEventListener('submit', function(event) {
            event.preventDefault(); 
            const messageText = document.getElementById('messageText').value;
            const currentFriendId2 = currentFriendId;

            fetch('../../inc/php/send_message_chat.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ message: messageText, idFriend: currentFriendId2 })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('messageText').value = "";
                } else {
                    // 
                }
            })
            .catch(error => {
                // 
            });
        });
    </script>
</body>
</html>
