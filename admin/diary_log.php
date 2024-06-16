<?php require_once('../inc/php/access.php'); ?>
<?php require_once('../inc/php/display_diary_log.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/style/style.css">
    <link rel="stylesheet" href="../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="backoffice_diary_log" class="backoffice">
    <?php require_once('../inc/components/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/components/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive mt-4">
                    <!-- ajouter un overflow -->
                    <table class="table table-striped table-sm border border-2 border-dark">
                        <tbody>
                        <?php 
                            foreach($res as $display) { 
                                echo '<tr><td>' . $display['id_log'] . '</td>';
                                echo '<td>' . $display['date_log'] . '</td>';
                                echo '<td>' . $display['log_action'] . '</td>';
                                echo '<td>' . $display['adresse_ip'] . '</td></tr>';
                            };
                        ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
