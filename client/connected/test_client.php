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
    <title>Envoyer un message</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Envoyer un message</h1>
        <form id="messageForm">
            <div class="form-group">
                <label for="messageText">Message</label>
                <textarea class="form-control" id="messageText" rows="3" maxlength="11" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <script>
        document.getElementById('messageForm').addEventListener('submit', function(event) {
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
