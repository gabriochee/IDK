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
<body id="backoffice_diary_log" class="backoffice">
    <?php require('../inc/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require('../inc/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive mt-4"><!-- ajouter un overflow -->
                    <form action="./database_editor.php" method="post">
                        <div class="col-12">
                            <label for="query-prompt" class="form-label fs-2">Requête</label>
                            <textarea class="form-control fs-3" id="query-prompt" name="query-prompt" rows="7" minlength="0" maxlength="500" required><?php if(isset($_POST['query-prompt'])){echo trim($_POST['query-prompt']);} ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary fs-2 mt-5">Envoyer</button>
                        <button type="button" class="btn btn-danger fs-2 mt-5" id="clear-button">Effacer</button>
                    </form>
                </div>
                <?php
                if (isset($_POST['query-prompt'])) {

                    $serverAddress = "152.228.217.19";
                    $username = "distant";
                    $password = "LEG2024IDKdistant!";

                    try {
                        $bdd = new PDO("mysql:host=$serverAddress;dbname=projet;port=3306", $username, $password);
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = $_POST['query-prompt'];
                        $result = $bdd->query($query);
                        $fetchedResult = $result->fetchAll();
                        if (!$fetchedResult){
                            echo 'vide.';
                        } else if (str_contains($query, "SHOW COLUMNS")) {
                            foreach ($fetchedResult as $row) {
                                echo $row['Field'] . " " . $row['Type'];
                                echo '<br>';
                            }
                        } else if (str_contains($query, "SELECT")){
                            echo '<table class=\'table\'><tr>';
                            for ($i = 0; $i < count($fetchedResult[0]); $i+=2){
                                echo "<th>" . array_keys($fetchedResult[0])[$i] . "</th>";
                            }
                            echo '</tr>';
                            foreach ($fetchedResult as $row) {
                                echo '<tr>';
                                for ($i = 0; $i < count($fetchedResult[0]); $i++) {
                                    echo "<td>" . $row[$i] . "</td>";
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
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>