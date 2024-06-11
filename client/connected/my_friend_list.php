<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header("Location: ../not_connected/login.php");
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
<body id="connected_my_friend_list">
    <?php require_once('../../inc/connected/header.php'); ?>
    <?php require_once('../../inc/php/db.php'); ?>
    <?php require_once('../../inc/php/affichage_data_user.php'); ?>
    <?php require_once('../../inc/php/function_search_user.php'); ?>
    <main>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-3" width="150px" src="../../inc/img/profile.svg">
                        <span class="text-black-50">#<?php echo $rep_data_user1['id_user']; ?></span>
                        <span><?php echo $rep_data_user1['pseudo']; ?></span>
                        <span><?php echo $rep_data_user1['nom'] .' '. $rep_data_user1['prenom']; ?></span>
                        <span><?php echo $rep_data_user2['count(*)']; ?> amis</span>
                    </div>
                </div>
                <div class="col-md-8 border-right">
                    <div class="py-3 d-flex justify-content-center">
                        <div class="row w-100">
                            <div class="col-12 border-1">
                                <div class="col-md-12 overflow-auto menu-oeuvre-2">
                                    <h3>Mes demandes envoyée :</h3> 
                                    <table class="table table-striped table-sm border border-1 border-dark mt-3">
                                        <tbody>
                                            <?php // Mettre une taille max !
                                                foreach($rep3 as $rep3) {
                                                    echo '<tr><td class="table-cell" scope="row">' . htmlspecialchars($rep3['pseudo']). ' - ' . htmlspecialchars($rep3['nom']).' '.htmlspecialchars($rep3['prenom']).'</td>';
                                                    echo '<td class="table-cell">le 14/04/2024</td>';
                                                    echo '<td class="table-cell text-end"><a href="my_friend_list.php?demande=cancel_req&id='.$rep3['id_user'].'" class="nav-btn btn btn-sm btn-outline-secondary" type="submit" name="envoyer_ami">Annuler</a></td>';
                                                    echo '</td></tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <h3>Mes demandes reçu :</h3>
                                    <table class="table table-striped table-sm border border-1 border-dark mt-3">
                                        <tbody>
                                            <?php // Mettre une taille max !
                                                foreach($rep2 as $rep2) {
                                                    echo '<tr><td class="table-cell" scope="row">' . htmlspecialchars($rep3['pseudo']). ' - ' . htmlspecialchars($rep3['nom']).' '.htmlspecialchars($rep3['prenom']).'</td>';
                                                    echo '<td class="table-cell">le 14/04/2024</td>';
                                                    echo '<td class="table-cell text-end">';
                                                    echo '<a href="my_friend_list.php?demande=be_friend&id='.$rep2['id_user'].'" class="nav-btn btn btn-sm btn-outline-secondary" type="submit" name="envoyer_ami">Accepter</a></td>';
                                                    echo '<a href="my_friend_list.php?demande=cancel_req_from_receiver&id='.$rep2['id_user'].'" class="nav-btn btn btn-sm btn-outline-secondary" type="submit" name="envoyer_ami">Refuser</a>';
                                                    echo '</td></tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="featurette-divider my-4">
                
                <h3 class="text-center mb-3">Rechercher un utilisateurs : </h3>
                <input type="search" onkeydown="searchKeywordUser()" class="form-control border border-2 border-dark mb-4" placeholder="Rechercher..." aria-label="Search" id="navbar_user">
                <div id="resultats_user" class="mb-3"></div>

                <h3 class="text-center">Mes amis : </h3>
                <div class="container text-center m-auto">
                    <div class="row row-cols-sm-3 row-cols-md-4">
                    <?php foreach($rep4 as $rep4) { ?>
                        <div class="col-3 col-md-3">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img class="mb-3" width="150px" src="../../inc/img/profile.svg">
                                <span class="text-black-50">#<?php echo $rep4['id_user']; ?></span>
                                <span><?php echo $rep4['pseudo']; ?></span>
                                <span><?php echo $rep4['nom'] .' '. $rep4['prenom']; ?></span>
                                <span>1 amis</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary mt-3" onclick="window.location='my_friend_list.php'">Contacter</button>
                                <?php echo '<a href="my_friend_list.php?demande=supp_friend&id='.$rep4['id_user'].'" class="nav-btn btn btn-sm btn-outline-secondary mt-1" type="submit" name="envoyer_ami">Supprimer</a>'; ?>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once('../../inc/connected/footer.php'); ?>
    <script src="../../inc/js/search_user.js"></script>
    <script src="../../inc/js/search_movie.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
