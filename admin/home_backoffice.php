<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/functions.php">
    <link rel="stylesheet" href="../inc/style.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="home_backoffice" class="backoffice">
    <?php require('../inc/php/db.php'); ?>
    <?php require('../inc/backoffice/header.php');?>
    <div class="container-fluid">
        <div class="row">
            <?php require('../inc/backoffice/sidebar.php');?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-4 border-bottom">
                    <h3>Administrateurs : </h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            Léo Belarbi #1 depuis 01/01/2024
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            Gabriel Plaaaaaa #2 depuis 01/01/2024
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            Eric Sang #3 depuis 01/01/2024
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                            </div>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-center">
                        <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-75 my-3" id="modifier-home">Ajouter un administrateur</button>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <h3>Statistiques : </h3>
                    <table class="table table-striped table-sm border border-2 border-dark">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">1 day</th>
                                <th scope="col">1 week</th>
                                <th scope="col">1 month</th>
                                <th scope="col">1 years</th>
                                <th scope="col">All</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Nombres d'utilisateurs connecté(s) :</th>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Nombres de profils administrateurs :</th>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Nombres d'utilisateurs inscrits :</th>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Nombres d'utilisations du questionnaire :</th>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Nombres d'utilisations de la fusion :</th>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Nombres d'utilisations de l'anti-film :</th>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Genre le plus conseillé pour films :</th>
                                <td>Horreur</td>
                                <td>Drama</td>
                                <td>Fantaisie</td>
                                <td>Horreur</td>
                                <td>Horreur</td>
                            </tr>
                            <tr>
                                <th scope="row">Genre le plus conseillé pour séries :</th>
                                <td>Horreur</td>
                                <td>Drama</td>
                                <td>Fantaisie</td>
                                <td>Horreur</td>
                                <td>Horreur</td>
                            </tr>
                            <tr>
                                <th scope="row">Moyenne d’age des utilisateurs inscrits :</th>
                                <td>1</td>
                                <td>3</td>
                                <td>2</td>
                                <td>3</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Moyenne de listes par utilisateurs hors les 2 par défaut à l’inscription :</th>
                                <td>1</td>
                                <td>3</td>
                                <td>2</td>
                                <td>3</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th scope="row">Nombres d’oeuvre dans la base :</th>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <th scope="row">Nombres de films dans la base :</th>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <th scope="row">Nombres de séries dans la base :</th>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>

        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>