<?php require_once('../../inc/php/access.php'); ?>
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
    <?php require_once('../../inc/components/connected/header.php'); ?>
    <?php require_once('../../inc/php/affichage_data_user.php'); ?>
    <?php require_once('../../inc/php/function_search_user.php'); ?>
    <main>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="card card-profile text-center border-0" style="background-color: transparent;">
                        <div class="card-body">
                            <img src="../../inc/img/user_img/<?php echo htmlspecialchars($rep_data_user1['photo_utilisateur']); ?>" alt="Photo de l'utilisateur" class="mb-3 card-img-top img-fluid rounded-circle">
                            <h4 class="card-title"><?php echo $rep_data_user1['pseudo'] .' (#'. $rep_data_user1['id_user'] .')'; ?></h4>
                            <p class="card-text text-start my-0"><?php echo $rep_data_user1['nom'] .' '. $rep_data_user1['prenom']; ?></p>
                            <p class="card-text text-start my-0">Inscrit depuis : <?php echo $rep_data_user1['date_inscription']; ?></p>
                            <span class="badge bg-secondary mt-3"><?php echo $rep_data_user2['nb_amis']; ?> amis</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="py-3 d-flex justify-content-center">
                        <div class="row w-100">
                            <div class="col-12 border-1">
                                <div class="col-md-12 overflow-auto menu-oeuvre-2" style="max-height: 500px;">
                                    <h3 class="mb-3">Mes demandes envoyées :</h3>
                                    <table class="table table-striped table-sm border border-1 border-dark">
                                        <tbody>
                                            <?php foreach ($rep3 as $rep3) { ?>
                                                <tr>
                                                    <td class="table-cell"><?php echo htmlspecialchars($rep3['pseudo']) . ' - ' . htmlspecialchars($rep3['nom']) . ' ' . htmlspecialchars($rep3['prenom']); ?></td>
                                                    <td class="table-cell">le 14/04/2024</td>
                                                    <td class="table-cell text-end">
                                                        <a href="my_friend_list.php?demande=cancel_req&id=<?php echo $rep3['id_user']; ?>" class="btn btn-sm btn-outline-secondary" type="submit" name="envoyer_ami">Annuler</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <h3 class="mb-3">Mes demandes reçues :</h3>
                                    <table class="table table-striped table-sm border border-1 border-dark">
                                        <tbody>
                                            <?php foreach ($rep2 as $rep) { ?>
                                                <tr>
                                                    <td class="table-cell"><?php echo htmlspecialchars($rep['pseudo']) . ' - ' . htmlspecialchars($rep['nom']) . ' ' . htmlspecialchars($rep['prenom']); ?></td>
                                                    <td class="table-cell">le 14/04/2024</td>
                                                    <td class="table-cell text-end">
                                                        <form action="my_friend_list.php" method="get" style="display: inline;">
                                                            <input type="hidden" name="demande" value="be_friend">
                                                            <input type="hidden" name="id" value="<?php echo $rep['id_user']; ?>">
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary" name="envoyer_ami">Accepter</button>
                                                        </form>
                                                        <form action="my_friend_list.php" method="get" style="display: inline;">
                                                            <input type="hidden" name="demande" value="cancel_req_from_receiver">
                                                            <input type="hidden" name="id" value="<?php echo $rep['id_user']; ?>">
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary" name="envoyer_ami">Refuser</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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

                <h3 class="text-center mt-4 mb-3">Mes amis :</h3>
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                        <?php foreach ($rep4 as $rep4) { ?>
                            <div class="col mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="../../inc/img/user_img/<?php echo htmlspecialchars($rep4['photo_utilisateur']); ?>" class="card-img-top img-fluid" style="height: 200px;" alt="Photo de l'utilisateur">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <h5 class="card-title username"><?php echo $rep4['pseudo']; ?></h5>
                                        <p class="card-text"><?php echo $rep4['nom'] . ' ' . $rep4['prenom']; ?></p>
                                        <span class="badge bg-secondary">1 ami</span>
                                            <button type="button" class="btn btn-sm btn-warning w-100 mt-3" onclick="window.location='chat_friend.php'">Contacter</button>
                                            <button type="button" class="btn btn-sm btn-warning w-100 mt-1" onclick="showFriendLists(this)" value="<?php echo $rep4['id_user'] ?>" data-bs-toggle="modal" data-bs-target="#listsModal">Voir les listes</button>
                                            <a href="my_friend_list.php?demande=supp_friend&id=<?php echo $rep4['id_user']; ?>" class="btn btn-sm btn-warning w-100 mt-1">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="modal fade" id="listsModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-5">Listes de l'ami</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-column" id="lists-results"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </main>
    <?php require_once('../../inc/components/connected/footer.php'); ?>
    <script src="../../inc/js/search_user.js"></script>
    <script src="../../inc/js/friend_lists.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>