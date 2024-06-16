<?php require_once('../../inc/php/access.php'); ?>
<?php require_once('../../inc/php/display_contenu_public.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/style/style.css">
    <link rel="stylesheet" href="../../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="connected_terms_and_conditions">
    <?php require_once('../../inc/components/connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h3 class="mt-1">A propos</h3>
                </div>
            </div>
        </div>
        <div class="container col-9 mb-5">
        <?php
            $content = '';
            foreach ($results as $line) {
                $content .= '<h3>' . htmlspecialchars($line['titre']) . '</h3>';
                $content .= '<p>' . nl2br(htmlspecialchars($line['corps'])) . '</p><br/>';
            }
            echo $content;
        ?>
        </div>
    </main>
    <?php require_once('../../inc/components/connected/footer.php'); ?>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>