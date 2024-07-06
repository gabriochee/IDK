<?php
require_once('../inc/php/access.php');
require_once('../inc/php/display_diary_log.php');

$logsPerPage = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $logsPerPage;

$totalLogsQuery = $bdd->query('SELECT COUNT(id_log) AS total FROM logs');
$totalLogs = $totalLogsQuery->fetch()['total'];
$totalPages = ceil($totalLogs / $logsPerPage);

$query = $bdd->prepare('SELECT id_log, date_log, log_action, adresse_ip FROM logs ORDER BY date_log DESC LIMIT :offset, :logsPerPage');
$query->bindValue(':offset', $offset, PDO::PARAM_INT);
$query->bindValue(':logsPerPage', $logsPerPage, PDO::PARAM_INT);
$query->execute();
$res = $query->fetchAll();
?>
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
                    <table class="table table-striped table-sm border border-2 border-dark">
                        <thead>
                            <tr>
                                <th>ID Log</th>
                                <th>Date Log</th>
                                <th>Action Log</th>
                                <th>Adresse IP</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            foreach($res as $display) { 
                                echo '<tr><td>' . htmlspecialchars($display['id_log']) . '</td>';
                                echo '<td>' . htmlspecialchars($display['date_log']) . '</td>';
                                echo '<td>' . htmlspecialchars($display['log_action']) . '</td>';
                                echo '<td>' . htmlspecialchars($display['adresse_ip']) . '</td></tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Précédent</a>
                        </li>
                        <?php
                        $maxLinks = 5;
                        $start = max(1, $page - intval($maxLinks / 2));
                        $end = min($totalPages, $page + intval($maxLinks / 2));

                        if ($start > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                            if ($start > 2) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                        }

                        for ($i = $start; $i <= $end; $i++) {
                            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">';
                            echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
                            echo '</li>';
                        }

                        if ($end < $totalPages) {
                            if ($end < $totalPages - 1) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                            echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '">' . $totalPages . '</a></li>';
                        }
                        ?>
                        <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Suivant</a>
                        </li>
                    </ul>
                </nav>

            </main>
        </div>
    </div>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
