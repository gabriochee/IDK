<?php
require_once('../../inc/php/access.php');

if (isset($_GET['id_liste'])) {
    $req = $bdd->prepare("SELECT date_creation, details, statut, id_user, nom FROM listes WHERE id_liste = :id_liste;");
    $req->bindParam(":id_liste", $_GET['id_liste']);
    $req->execute();

    $res = $req->fetchAll();
    $nomListe = $res[0]['nom'];
    $dateCreation = $res[0]['date_creation'];
    $idOwner = $res[0]['id_user'];
    $statut = $res[0]['statut'];
    $details = $res[0]['details'];

    $req = $bdd->prepare("SELECT pseudo, date_inscription FROM utilisateur WHERE id_user = :id_user;");
    $req->bindParam(":id_user", $idOwner);
    $req->execute();

    $res = $req->fetchAll();
    $pseudoProprietaire = $res[0]['pseudo'];
    $dateInscription = $res[0]['date_inscription'];

    $req = $bdd->prepare("SELECT date_log FROM logs WHERE INSTR(log_action, :id_liste) AND INSTR(log_action, 'liste') ORDER BY date_log DESC LIMIT 1;");
    $req->bindParam(":id_liste", $_GET['id_liste']);
    $req->execute();

    $res = $req->fetch();
    $dateMaj = $res['date_log'];

    $req = $bdd->prepare("SELECT COUNT(id_work) as public_ratings_number FROM avis WHERE statut = 'publique' AND id_user = :id_user;");
    $req->bindParam(':id_user', $idOwner);
    $req->execute();

    $res = $req->fetch();
    $nbCritiquesPubliques = $res['public_ratings_number'];

    $req = $bdd->prepare("SELECT COUNT(id_liste) as public_lists_number FROM listes WHERE statut = 'publique' AND id_user = :id_user;");
    $req->bindParam(':id_user', $idOwner);
    $req->execute();

    $res = $req->fetch();
    $nbListesPubliques = $res['public_lists_number'];
} else {
    header("Location: ../not_connected/home.php");
    exit();
}
?>

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

<body id="connected_private_list" class="no-x-overflow">
    <?php require_once('../../inc/php/db.php'); ?>
    <?php require_once('../../inc/components/not_connected/header.php'); ?>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h3 class="mt-1"><?php echo $nomListe; ?></h3>
                </div>
            </div>
        </div>
        <div class="container col-10 mb-5">
            
            <div class="container-fluid d-flex flex-column">
                <p class="fs-6 m-0">Crée le : <?php echo $dateCreation; ?></p>
                <p class="fs-6 m-0">Dernière mise à jour le : <?php echo $dateMaj; ?></p>
                <p class="fs-6 m-0">Auteur : <?php echo $pseudoProprietaire; ?></p>

                <p class="fs-6 m-0"><?php echo $nbCritiquesPubliques; ?> critique<?php echo ($nbCritiquesPubliques > 1) ? 's' : '';?> publique<?php echo ($nbCritiquesPubliques > 1) ? 's' : '';?></p>
                <p class="fs-6 m-0"><?php echo $nbListesPubliques; ?> liste<?php echo ($nbListesPubliques > 1) ? 's' : '';?> publique<?php echo ($nbListesPubliques > 1) ? 's' : '';?></p>
                <p class="fs-6 m-0">Inscrit le : <?php echo $dateInscription; ?></p>
                <hr>
                <p class="fs-6 m-0">Description : <b><?php echo $details; ?></b></p>
                <hr>
            </div>

            <div class="container mt-5 p-0 w-100 m-auto border border-3 border-dark rounded-3 overflow-auto no-overflow-x" style="background-color: #CFDBD5; height: 100%;">
                <div class="d-lg-flex row gx-2 gy-3 px-3 py-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4" id="cards-container">
                    <?php
                        if (isset($_GET['id_liste'])) {
                            $req = $bdd->prepare("SELECT element_liste.id_work, work_basics.primaryTitle, work_basics.startYear FROM element_liste JOIN work_basics ON element_liste.id_work = work_basics.id_work WHERE id_liste = :id_liste ORDER BY date_ajout;");
                            $req->bindParam(":id_liste", $_GET['id_liste']);
                            $req->execute();
                            $res;
                            while (($res = $req->fetch()) != null) {
                                $filmName = $res['primaryTitle'];
                                $filmId = $res['id_work'];
                                $filmYear = $res['startYear'];
                                require('../../inc/components/card_nc.php');
                            }
                        }
                    ?>
                </div>
            </div>
    </main>
    <?php require_once('../../inc/components/not_connected/footer.php'); ?>
    <script>
        const id_liste = <?php echo $_GET['id_liste']; ?>;
    </script>
    <script src="../../inc/js/private_list.js"></script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>