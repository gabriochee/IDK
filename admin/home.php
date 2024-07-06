<?php require_once('../inc/php/access.php'); ?>
<?php require_once('../inc/php/display_home_backoffice.php'); ?>
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
<body id="backoffice_home" class="backoffice">
    <?php require_once('../inc/components/backoffice/header.php');?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/components/backoffice/sidebar.php');?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Nombres d'utilisateurs connectées</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">10</small></h1>
                    </div>
                </div>
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal"><?php echo 'Nombres d\'oeuvre stockée dans la base (' . date("Y-m-d H:i:s") . ')'; ?></h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><small class="text-muted fw-light"><?php echo $res_nb_oeuvre['nb_oeuvre']; ?></small></h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Moyennes d'ages des utilisateurs</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><small class="text-muted fw-light"><?php echo $res_moyenne_age['moyenne_age']; ?> ans</small></h1>
                    </div>
                </div>
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Moyennes d'ages des utilisateurs connectées</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">29 ans</small></h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Proportions des genres</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Hommes : <?php echo $res_genre['hommes']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Femmes : <?php echo $res_genre['femmes']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Autres : <?php echo $res_genre['autres']; ?></span>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Nombres d'inscriptions</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Aujourd'hui : <?php echo $res_nb_inscription['today']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Cette semaine : <?php echo $res_nb_inscription['semaine']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Ce mois : <?php echo $res_nb_inscription['mois']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Cette année : <?php echo $res_nb_inscription['annee']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Total : <?php echo $res_nb_inscription['total']; ?></span>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Nombres de listes crée</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Aujourd'hui : <?php echo $res_creation_listes['today']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Cette semaine : <?php echo $res_creation_listes['semaine']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Ce mois : <?php echo $res_creation_listes['mois']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Cette année : <?php echo $res_creation_listes['annee']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Total : <?php echo $res_creation_listes['total']; ?></span>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Nombres moyennes de listes par utilisateurs <small>(hors "A voir" et "Déja vu")</small></h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><small class="text-muted fw-light"><?php echo $res_moyenne_listes['moyenne_liste']; ?></small></h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Nombres de questionnaires</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Aujourd'hui : <?php echo $res_nb_questionnaire['today']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Cette semaine : <?php echo $res_nb_questionnaire['semaine']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Ce mois : <?php echo $res_nb_questionnaire['mois']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Cette année : <?php echo $res_nb_questionnaire['annee']; ?></span>
                                <span class="badge rounded-pill text-bg-warning fw-light w-100">Total : <?php echo $res_nb_questionnaire['total']; ?></span>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">L'année la plus choisis - Total</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <?php foreach ($res_questionnaire_annee as $annee) : ?>
                                    <span class="badge rounded-pill text-bg-warning fw-light w-100"><?php echo $annee; ?></span>
                                <?php endforeach; ?>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">La provenance la plus choisis - Total</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <?php foreach ($res_questionnaire_origine as $origine) : ?>
                                    <span class="badge rounded-pill text-bg-warning fw-light w-100"><?php echo $origine; ?></span>
                                <?php endforeach; ?>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Genres les plus choisis - Aujourd'hui</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <?php foreach ($today as $genre => $count) : ?>
                                    <span class="badge rounded-pill text-bg-warning fw-light w-100"><?php echo htmlspecialchars($genre) . ' : ' . $count; ?></span>
                                <?php endforeach; ?>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Genres les plus choisis - Cette semaine</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <?php foreach ($thisWeek as $genre => $count) : ?>
                                    <span class="badge rounded-pill text-bg-warning fw-light w-100"><?php echo htmlspecialchars($genre) . ' : ' . $count; ?></span>
                                <?php endforeach; ?>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Genres les plus choisis - Ce mois</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <?php foreach ($thisMonth as $genre => $count) : ?>
                                    <span class="badge rounded-pill text-bg-warning fw-light w-100"><?php echo htmlspecialchars($genre) . ' : ' . $count; ?></span>
                                <?php endforeach; ?>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Genres les plus choisis - Cette année</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <?php foreach ($thisYear as $genre => $count) : ?>
                                    <span class="badge rounded-pill text-bg-warning fw-light w-100"><?php echo htmlspecialchars($genre) . ' : ' . $count; ?></span>
                                <?php endforeach; ?>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Genres les plus choisis - Total</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            <small class="text-muted">
                                <?php foreach ($total as $genre => $count) : ?>
                                    <span class="badge rounded-pill text-bg-warning fw-light w-100"><?php echo htmlspecialchars($genre) . ' : ' . $count; ?></span>
                                <?php endforeach; ?>
                            </small>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
            </main>

        </div>
    </div>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<div class="col-12">
                        <h1>mettre tableau des pages les plus visiter filtrable (jour:defaut, semaine, mois, année, all)</h1>
                    </div>