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
                    <form action="./database_editor.php" method="POST">
                        <div class="col-12">
                            <label for="query-prompt" class="form-label fs-2">Requête</label>
                            <textarea class="form-control fs-3" id="query-prompt" name="query-prompt" rows="7" minlength="0" maxlength="1000" required><?php if (isset($_POST['query-prompt'])) { echo trim($_POST['query-prompt']); } ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary fs-2 mt-5">Envoyer</button>
                        <button type="button" class="btn btn-danger fs-2 mt-5" id="clear-button">Effacer</button>
                    </form>
                </div>
                <?php
                if (isset($_POST['query-prompt'])) {
                    require_once('../inc/php/db.php');

                    try {
                        $query = $_POST['query-prompt'];
                        $result = $bdd->query($query);
                        $fetchedResult = $result->fetchAll();
                        
                        if (!$fetchedResult) {
                            echo 'vide.';
                        } else if (str_contains($query, "SHOW COLUMNS")) {
                            foreach ($fetchedResult as $row) {
                                echo $row['Field'] . " " . $row['Type'];
                                echo '<br>';
                            }
                        } else if (str_contains($query, "SELECT")) {
                            echo '<table class="table table-responsive"><tr>';
                            foreach ($fetchedResult[0] as $attribute => $value) {
                                echo "<th>" . $attribute . "</th>";
                            }
                            echo '</tr>';
                            foreach ($fetchedResult as $row) {
                                echo '<tr>';
                                foreach ($row as $key => $value){
                                    echo "<td>" . $value . "</td>";
                                }
                                echo '</tr>';
                            }
                            echo '</table>';
                        } else {
                            var_dump($fetchedResult);
                        }
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                        echo '<br>';
                        echo "Code erreur : " . $e->getCode();
                    }
                }
                ?>
            </main>
        </div>
    </div>
    <script src="../inc/js/database_editor.js"></script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
