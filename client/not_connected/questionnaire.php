<?php 
if(isset($_SESSION['id_user'])) {
    header("Location: ../connected/home.php");
    exit();
}
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
<body id="not_connected_questionnaire">
    <?php require_once('../../inc/php/db.php'); ?>
    <?php require_once('../../inc/not_connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h3 class="mt-1">Questionnaire</h3>
                </div>
            </div>
        </div>
        <div class="container text-center col-lg-6 my-md-5 py-5">
            <h3>Question 1 : A chaque réponse avec dans certains cas plusieurs possibles, la question se supprime et celle d’apres apparait car en fonction les prochaines question seront différentes, avec un fil d’ariane des réponses.</h3>
        </div>
        <div class="container-fluid justify-content-center row row-cols-3 col-lg-6 px-0 mx-auto mb-5">
            <div class="container col-4 text-center py-md-3">
                <button class="col nav-btn btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-sm-5 px-3">Réponse 1</button>
            </div>

            <div class="container col-4 text-center py-1 py-md-3">
                <button class="col nav-btn btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-sm-5 px-3">Réponse 1</button>
            </div>

            <div class="container col-4 text-center py-1 py-md-3">
                <button class="col nav-btn btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-sm-5 px-3">Réponse 1</button>
            </div>

            <div class="container col-4 text-center py-1 py-md-3">
                <button class="col nav-btn btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-sm-5 px-3">Réponse 1</button>
            </div>

            <div class="container col-4 text-center py-1 py-md-3">
                <button class="col nav-btn btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-sm-5 px-3">Réponse 1</button>
            </div>

            <div class="container col-4 text-center py-1 py-md-3">
                <button class="col nav-btn btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-sm-5 px-3">Réponse 1</button>
            </div>
    </main>
    <h6 class="ms-md-5">Question 1 : <span class="fw-bold">Réponse 1</span> > Question 2 : <span class="fw-bold">Réponse 1 & Réponse 2</span> > Question 3 : <span class="fw-bold">Réponse 1</span></h6>
    <?php require_once('../../inc/not_connected/footer.php'); ?>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>