<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
    <title>Exporter les données de l'utilisateur</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Exporter les donnees de l'utilisateur en PDF</h1>
        <form action="test.php" method="POST">
            <div class="form-group">
                <label for="userId">ID de l'utilisateur :</label>
                <input type="number" class="form-control" id="userId" name="userId" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Créer PDF</button>
        </form>
    </div>
    <script src="path/to/bootstrap.bundle.min.js"></script>
</body>
</html>
