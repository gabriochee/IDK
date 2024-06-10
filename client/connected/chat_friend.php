<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header("Location: ../not_connected/login.php");
    exit();
}
?>


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
        .date_size{
            font-size: 0.5em;
        }
        .message-container {
            max-height: 400px; /* Définissez une hauteur maximale en fonction de vos besoins */
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <?php require('../../inc/connected/header.php'); ?>
    <?php require('../../inc/php/function_chat_friend.php'); ?>
    <h1 class="text-center my-5">Chat with your Friend</h1>
    <section style="background-color: #E8EDDF;">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                    <h5 class="font-weight-bold mb-3 text-center text-lg-start">My Friend</h5>
                    <div class="container mt-5">
                        <div class="row" id="friendsList">
                            <!-- Les amis ici-->
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-8">
                    <h5 class="font-weight-bold mb-3 text-center" id="friend-name">Le nom de la personne</h5>
                    <div class="message-container">
                        <ul class="list-unstyled">

                            <div class="container mt-5">
                                <div class="row" id="message_list">
                                </div>
                            </div>
                        </ul>
                    </div>
                    <form id="myMessage">
                        <li class="bg-white mb-3">
                            <div data-mdb-input-init class="form-outline">
                                <textarea class="form-control" id="messageText" rows="4" name="user_message"></textarea>
                                <label class="form-label" for="myText">Message</label>
                            </div>
                        </li>
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-rounded float-end" name="send_message">Send</button>
                    </form>
                </div>

            </div>
        </div>
        
    </section>
    <?php require('../../inc/connected/footer.php'); ?>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        let intervalId = null; 
        let currentFriendId = 0; // variable pour stocker l'id de l'utilisateur qu'on a cliqué et qu'on a 
        //fetch mes amis pour que je puisse cliquer et envoyer message a cet amis
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof friendData !== 'undefined') {
                let listFriend = document.getElementById('friendsList');

                friendData.forEach(function(friend) {
                    let listItem = document.createElement('div');
                    listItem.className = 'p-2 border-bottom';
                    listItem.style.backgroundColor = '#eee';
                    listItem.innerHTML = `
                        <a id="ami" onclick="fetchFriendConv('${friend.pseudo}', ${friend.id_user})" name="friendDisplay" class="d-flex justify-content-between">
                            <div class="d-flex flex-row">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                <div class="pt-1">
                                    <p class="fw-bold mb-0" id="ici">${friend.pseudo}</p>
                                    <p class="small text-muted" id ="la">${friend.prenom} ${friend.nom}</p>
                                </div>
                            </div>
                            <div class="pt-1">
                                <p class="small text-muted mb-1">Just now</p>
                                <span class="badge bg-danger float-end">1</span>
                            </div>
                        </a>
                    `;
                    listFriend.appendChild(listItem);
                });
            } else {
                console.error('friendData n\'est pas défini');
            }
        });

        function fetchFriendConv(pseudo, id_user) {
            console.log("Friend clicked:", pseudo);
            console.log("id of clicked:", id_user);
            
            document.getElementById('friend-name').innerText = pseudo;
            currentFriendId = id_user; // Mise à jour de la variable globale à utiliser pour savoir à qui envoyer
            //function send_id(currentFriendId);
            if (intervalId) {
                clearInterval(intervalId);
            }
            send_id(currentFriendId);
        }

        function send_id(currentFriendId) {
            intervalId = setInterval(() => {
                const me = <?php echo $_SESSION['id_user']; ?>;
                console.log("iciiiiiiiiiiiiiiiiiiiiii",me);
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
                            console.log(data);
                            alert('je comprend pas ');
                    } else {
                        console.log(data);
                        document.querySelector('#message_list').innerHTML = '';

                        data.forEach(message => {
                            const li = document.createElement('li');
                            li.classList.add('d-flex', 'mb-4');
                            //true si msg = var de session
                            const isSender = message.id_user_1 == <?php echo $_SESSION['id_user']; ?>;
                            //moi
                            if (isSender) {
                                li.classList.add('justify-content-end');
                            } 
                            //autre
                            else {
                                li.classList.add('justify-content-start');
                            }

                            const card = document.createElement('div');
                            card.classList.add('card');
                            //moi
                            if (isSender) {
                                card.classList.add('text-end');
                                card.classList.add('text-success');
                                
                            } 
                            //other
                            else {
                                card.classList.add('text-start');
                                card.classList.add('text-danger');
                            }

                            const cardHeader = document.createElement('div');
                            cardHeader.classList.add('card-header', 'd-flex', 'justify-content-between', 'p-3');
                            
                            
                            const cardBody = document.createElement('div');
                            cardBody.classList.add('card-body');

                            const messageUser = document.createElement('p');
                            //me
                            if (isSender) {
                                messageUser.textContent= 'me';
                                messageUser.classList.add('pseudo_size');
                            } 
                            //other
                            else {
                                messageUser.textContent= message.pseudo_other;
                                messageUser.classList.add('pseudo_size');
                            }
                                
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

                            const avatar = document.createElement('img');
                            avatar.src = message.avatar;
                            avatar.alt = 'avatar';
                            avatar.classList.add('rounded-circle', 'd-flex', 'align-self-start', 'ms-3', 'shadow-1-strong');
                            avatar.width = 60;

                            li.appendChild(avatar);
                            console.log(currentFriendId);
                            document.querySelector('#message_list').appendChild(li);
                        });

                    }
                })
                .catch(error => {
                    console.error('t nul:', error);
                });
            }, 1000); // 7000 millisecondes = 7 secondes
        }

        document.getElementById('myMessage').addEventListener('submit', function(event) {
            event.preventDefault(); 
            const messageText = document.getElementById('messageText').value;
            const currentFriendId2 = currentFriendId;
            console.log("Current friend ID:", currentFriendId2);

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
                    alert('Message envoyé avec succès !');
                } else {
                    console.log(data);
                    alert('Erreur lors de l\'envoi du message.');
                    console.log("ID de l'utilisateur (me):", data.me);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        });
    </script>
</body>
</html>
