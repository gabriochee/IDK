<?php 
session_start();

if(isset($_SESSION['user_id'])) {
    header("Location: ../not_connected/login.php");
    exit();
}
?>
<<<<<<< HEAD
=======
<?php require('../../inc/php/function_chat_friend.php'); ?>
>>>>>>> 0a10bdbd6c388060997a8b931818cba528cc1445

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
    <?php require('../../inc/connected/header.php'); ?>
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
                    <ul class="list-unstyled">

                        <div class="container mt-5">
                            <div class="row" id="message_list">
                                
                            </div>
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
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <?php require('../../inc/connected/footer.php'); ?>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        var currentFriendId = 0; // variable globale pour stocker l'id de l'utilisateur qu'on a cliqué et qu'on a 

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
            send_id(currentFriendId);
        }

        function send_id(currentFriendId) {
    setInterval(() => {
        fetch('../../inc/php/function_fetch_message.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ currentFriendId: currentFriendId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                alert('Message envoyé fail!');
            } else {
                console.log(data);
                document.querySelector('#message_list').innerHTML = '';

                data.forEach(message => {
                    const li = document.createElement('li');
                    li.classList.add('d-flex', 'justify-content-between', 'mb-4');

                    const card = document.createElement('div');
                    card.classList.add('card', 'w-100');

                    const cardHeader = document.createElement('div');
                    cardHeader.classList.add('card-header', 'd-flex', 'justify-content-between', 'p-3');

                    const senderName = document.createElement('p');
                    senderName.classList.add('fw-bold', 'mb-0');
                    senderName.textContent = message.sender_name;
                    cardHeader.appendChild(senderName);

                    const sendDate = document.createElement('p');
                    sendDate.classList.add('text-muted', 'small', 'mb-0');
                    sendDate.innerHTML = '<i class="far fa-clock"></i> ' + message.date_message;
                    cardHeader.appendChild(sendDate);

                    const cardBody = document.createElement('div');
                    cardBody.classList.add('card-body');
                    const messageContent = document.createElement('p');
                    messageContent.classList.add('mb-0');
                    messageContent.textContent = message.contenu_message;
                    cardBody.appendChild(messageContent);
                    card.appendChild(cardBody);

                    li.appendChild(card);

                    const avatar = document.createElement('img');
                    avatar.src = message.avatar;
                    avatar.alt = 'avatar';
                    avatar.classList.add('rounded-circle', 'd-flex', 'align-self-start', 'ms-3', 'shadow-1-strong');
                    avatar.width = 60;

                    li.appendChild(avatar);

                    document.querySelector('#message_list').appendChild(li);
                });
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    }, 1000); // 5000 millisecondes = 5 secondes
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
