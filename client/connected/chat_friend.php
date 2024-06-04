<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header("Location: ../not_connected/login.php");
    exit();
}
?>
<?php require('../../inc/php/function_chat_friend.php'); ?>

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
                            <!-- les Cards -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-8">
                    <h5 class="font-weight-bold mb-3 text-center" id="friend-name">le nom de la personne</h5>
                    <?php //echo '<h5 class="font-weight-bold mb-3 text-center ">. htmlspecialchars($rep1['pseudo']).</h5>'; ?>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between mb-4">
                            <div class="card w-100">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Lara Croft</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
                                    </p>
                                </div>
                            </div>
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                        </li>
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
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof friendData !== 'undefined') {
                let listFriend = document.getElementById('friendsList');
                
                friendData.forEach(function(friend) {
                    let listItem = document.createElement('div');
                    listItem.className = 'p-2 border-bottom';
                    listItem.style.backgroundColor = '#eee';
                    listItem.innerHTML = `
                        <a id="ami" onclick="test('${friend.pseudo}, ${friend.id_user}')" name="friendDisplay" class="d-flex justify-content-between">
                            <div class="d-flex flex-row">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                <div class="pt-1">
                                    <p class="fw-bold mb-0">${friend.pseudo}</p>
                                    <p class="small text-muted">${friend.prenom} ${friend.nom}</p>
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

        function test(pseudo, idCurrentFriend) {
            console.log("Friend clicked:", pseudo);
            
            document.getElementById('friend-name').innerText = pseudo;
            currentFriend =idCurrentFriend;
            console.log(currentFriend);
        }

        document.getElementById('myMessage').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêcher le rechargement de la page
            const messageText = document.getElementById('messageText').value;

            fetch('test_server.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ message: messageText })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Message envoyé avec succès !');
                } else {
                    alert('Erreur lors de l\'envoi du message.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        });
    </script>
</body>
</html>