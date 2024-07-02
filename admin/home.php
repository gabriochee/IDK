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
    <?php require_once('../inc/php/affichage_data_user.php'); ?>
    <?php require_once('../inc/components/backoffice/header.php');?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/components/backoffice/sidebar.php');?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="row row-cols-1 row-cols-md-3 mb-3 text-center mt-5">
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
                                <h4 class="my-0 fw-normal"><?php echo 'Nombres d\'oeuvre stockée dans la base (' . date("Y-m-d H:i:s") . ')';?></h4>
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
                                    <small class="text-muted fw-light"><ul class="text-start">
                                        <li><small class="text-muted fw-light">Hommes : <?php echo $res_genre['hommes']; ?></small></li>
                                        <li><small class="text-muted fw-light">Femmes : <?php echo $res_genre['femmes']; ?></small></li>
                                        <li><small class="text-muted fw-light">Autres : <?php echo $res_genre['autres']; ?></small></li>
                                    </ul></small>
                                </h1>
                            </div>
                        </div>
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal">Nombres d'inscriptions</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">
                                    <small class="text-muted fw-light"><ul class="text-start">
                                        <li><small class="text-muted fw-light">Aujourd'hui : <?php echo $res_nb_inscription['today']; ?></small></li>
                                        <li><small class="text-muted fw-light">Cette semaine : <?php echo $res_nb_inscription['semaine']; ?></small></li>
                                        <li><small class="text-muted fw-light">Ce mois : <?php echo $res_nb_inscription['mois']; ?></small></li>
                                        <li><small class="text-muted fw-light">Cette année : <?php echo $res_nb_inscription['annee']; ?></small></li>
                                        <li><small class="text-muted fw-light">Total : <?php echo $res_nb_inscription['total']; ?></small></li>
                                    </ul></small>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal">Nombres de listes crée</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">
                                    <small class="text-muted fw-light"><ul class="text-start">
                                        <li><small class="text-muted fw-light">Aujourd'hui : <?php echo $res_creation_listes['today']; ?></small></li>
                                        <li><small class="text-muted fw-light">Cette semaine : <?php echo $res_creation_listes['semaine']; ?></small></li>
                                        <li><small class="text-muted fw-light">Ce mois : <?php echo $res_creation_listes['mois']; ?></small></li>
                                        <li><small class="text-muted fw-light">Cette année : <?php echo $res_creation_listes['annee']; ?></small></li>
                                        <li><small class="text-muted fw-light">Total : <?php echo $res_creation_listes['total']; ?></small></li>
                                    </ul></small>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal">Nombres moyennes de listes par utilisateurs <small>(hors "A voir" et "Déja vu")</small></h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">2</small></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3"><canvas id="nb_questionnaire"></canvas></div>
                    <div class="col-md-6 mt-3"><canvas id="nb_fusion"></canvas></div>
                    <div class="col-md-4 mt-3"><canvas id="repart_genre_all"></canvas></div>
                    <div class="col-md-2 mt-3 d-flex align-items-center"><canvas id="repart_genre_day"></canvas></div>
                    <div class="col-md-2 mt-3 d-flex align-items-center"><canvas id="repart_genre_week"></canvas></div>
                    <div class="col-md-2 mt-3 d-flex align-items-center"><canvas id="repart_genre_month"></canvas></div>
                    <div class="col-md-2 mt-3 d-flex align-items-center"><canvas id="repart_genre_year"></canvas></div>
                    <div class="col-12">
                        <h1>mettre tableau des pages les plus visiter filtrable (jour:defaut, semaine, mois, année, all)</h1>
                    </div>
                </div>
            </main>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../inc/js/home_backoffice.js"></script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
