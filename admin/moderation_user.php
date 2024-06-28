<?php require_once('../inc/php/access.php'); ?>
<?php require_once('../inc/php/affichage_data_user.php'); ?>
<?php require_once('../inc/library/fpdf/function_fpdf_admin.php'); ?>
<?php require_once('../inc/php/function_create_admin.php'); ?>
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
<body id="backoffice_moderation_user" class="backoffice">
    <?php require_once('../inc/components/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/components/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <form action="moderation_user.php" method="POST">
                    <div class="form-group">
                        <label for="userId">Exporter en pdf il faut saisir l'id de l'utilisateur:</label>
                        <input type="number" class="form-control" id="userId" name="userId" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Créer PDF</button>
                </form>

                <div class="table-responsive mt-4">
                    <h3 class="mb-3">Utilisateurs : </h3>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['id_user'])) {
                            try {
                                $result = $bdd->query("UPDATE utilisateur SET nom = '{$_POST['lastName']}', prenom = '{$_POST['firstName']}', pseudo = '{$_POST['pseudo']}', sexe = '{$_POST['sexe']}', date_naissance = \"{$_POST['birthday-year']}-{$_POST['birthday-month']}-{$_POST['birthday-day']}\", mail = '{$_POST['mail']}', telephone = '{$_POST['phone']}' WHERE id_user = {$_POST['id_user']};");
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                        }
                    }
                    ?>
                    <input class="form-control form-control-white w-100 mb-3" type="text" placeholder="Recherche" aria-label="Search">
                    <div class="overflow-auto menu-oeuvre-2">
                        <table class="table table-striped table-sm border border-3 border-dark" id="users-table">
                            <thead class="table-dark">
                                <tr>
                                    <th class="table-cell" scope="col">#id</th>
                                    <th class="table-cell" scope="col">Prenom Nom</th>
                                    <th class="table-cell" scope="col">Pseudo</th>
                                    <th class="table-cell" scope="col">Sexe</th>
                                    <th class="table-cell" scope="col">Date d'inscritpion</th>
                                    <th class="table-cell" scope="col">Email</th>
                                    <th class="table-cell" scope="col">Date de naissance</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userInformations = false;

                                if (isset($_POST['show'])) {
                                    $userInformations = ($bdd->query("SELECT id_user, nom, prenom, pseudo, sexe, date_inscription, mail, telephone, date_naissance FROM utilisateur WHERE id_user = {$_POST['show']};"))->fetchAll();
                                } else if (isset($_POST['ban-id'])) {
                                    $sql = "INSERT INTO ban(definitif, date_ban, date_deban, raison, id_user) VALUES (:definitif, :dateban, :datedeban, :raison, :id_user)";
                                    $prep = $bdd->prepare($sql);
                                    $prep->bindValue(":id_user", intval($_POST['ban-id']));
                                    $prep->bindValue(":definitif", (isset($_POST['definitif']) ? 1 : 0));
                                    $prep->bindValue(":dateban", date("Y-m-d H-i-s"));

                                    $interval = new DateInterval('P' . $_POST['ban-time-year'] . 'Y' . $_POST['ban-time-month'] . 'M' . $_POST['ban-time-day'] . 'DT' . $_POST['ban-time-hour'] . 'H' . $_POST['ban-time-minute'] . 'M' . $_POST['ban-time-second'] . 'S');

                                    $date_deban = (new DateTime('now'))->add($interval);

                                    $prep->bindValue(":datedeban", $date_deban->format("Y-m-d H-i-s"));
                                    $prep->bindParam(":raison", $_POST['raison']);

                                    try {
                                        $prep->execute();
                                    } catch (PDOException $e) {
                                        echo $e->getMessage();
                                    }
                                } else if (isset($_POST['delete-id'])){
                                    $sql = "UPDATE utilisateur SET supprime = 1 WHERE id_user = :id";
                                    $prep = $bdd->prepare($sql);
                                    $prep->bindValue(":id", $_POST['delete-id']);

                                    try {
                                        $prep->execute();
                                    } catch (PDOException $e){
                                        echo $e->getMessage();
                                    }
                                    
                                } else if (isset($_POST['unban-id'])){
                                    $req = $bdd->prepare("UPDATE ban SET date_deban = NOW(), definitif = FALSE WHERE id_user = :id_user ORDER BY id_ban DESC LIMIT 1;");
                                    $req->bindParam(":id_user", $_POST['unban-id']);

                                    $req->execute();
                                }
                                
                                try {
                                    $queryResponse = $bdd->query("SELECT utilisateur.id_user, CONCAT(prenom, ' ', nom) AS prenom_nom, pseudo, sexe, date_inscription, mail, date_naissance FROM utilisateur LEFT JOIN ban ON ban.id_user = utilisateur.id_user WHERE supprime = 0 AND (ban.definitif = 0 OR ban.definitif IS NULL) AND (ban.date_deban < NOW() OR ban.date_deban IS NULL) GROUP BY utilisateur.id_user;");
                                } catch (PDOException $e) {
                                    echo $e->getMessage();
                                }

                                $result = $queryResponse->fetchAll();
                                $idUser;

                                foreach ($result as $row) {
                                    echo '<tr>';
                                    foreach ($row as $key => $info) {
                                        if (gettype($key) === 'string') {
                                            if ($key == 'id_user') {
                                                $idUser = $info;
                                                $info = '#' . $info;
                                            }
                                            echo '<td class="table-cell">' . $info . '</td>';
                                        }
                                    }
                                    echo '<form action="moderation_user.php" method="post">';
                                    echo '<td class="table-cell"><button type="submit" class="btn btn-sm btn-outline-secondary" name=show value=' . $idUser . '>En voir plus</button></td>';
                                    echo '<td class="table-cell"><button type="button" class="btn btn-sm btn-warning ban-menu-btn" data-bs-toggle="modal" data-bs-target="#banModal" value=' . $idUser . '>Bannir</button></td>';
                                    echo '<td class="table-cell"><button type="button" class="btn btn-sm btn-danger delete-menu-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" name=delete value=' . $idUser . '>Supprimer</button></td>';
                                    echo '</form>';
                                    echo '</tr>';
                                }
                                ?>
                                <div class="modal fade" id="banModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Voulez vous bannir cet utilisateur ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="moderation_user.php" method="post">
                                                <div class="modal-body">
                                                    <div class="container align-items-center fs-5">
                                                        <input class="form-check-input p-1" type="checkbox" name="definitif" id="definitif" data-bs-toggle="collapse" data-bs-target="#duree-ban">
                                                        <label for="definitif">Bannir définitivement</label>
                                                    </div>
                                                    <div class="container mt-3">
                                                        <label for="raison">Raison</label>
                                                        <input type="text" class="form-control" name="raison" id="raison" required>
                                                    </div>
                                                    <div class="collapse show mt-3" id="duree-ban">
                                                        <div class="container d-flex justify-content-center">
                                                            <div class="row row-cols-2 col-7">
                                                                <label for="ban-time-year" class="col text-end">Année(s)</label>
                                                                <input type="number" name="ban-time-year" class="col" id="ban-time-year" min=0 max=100 value="0">

                                                                <label for="ban-time-month" class="col text-end">Mois</label>
                                                                <input type="number" name="ban-time-month" class="col" id="ban-time-month" min=0 max=1000 value="0">

                                                                <label for="ban-time-day" class="col text-end">Jour(s)</label>
                                                                <input type="number" name="ban-time-day" class="col" id="ban-time-day" min=0 max=1000 value="0">

                                                                <label for="ban-time-hour" class="col text-end">Heure(s)</label>
                                                                <input type="number" name="ban-time-hour" class="col" id="ban-time-hour" min=0 max=10000 value="0">

                                                                <label for="ban-time-minute" class="col text-end">Minute(s)</label>
                                                                <input type="number" name="ban-time-minute" class="col" id="ban-time-minute" min=0 max=10000 value="0">

                                                                <label for="ban-time-second" class="col text-end">Seconde(s)</label>
                                                                <input type="number" name="ban-time-second" class="col" id="ban-time-second" min=0 max=10000 value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="ban-btn" class="btn btn-danger" name="ban-id">Bannir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="mb-3 mt-3">Utilisateurs bannis: </h3>
                    <div class="overflow-auto menu-oeuvre-2">
                        <table class="table table-striped table-sm border border-3 border-dark" id="users-table">
                            <thead class="table-dark">
                                <tr>
                                    <th class="table-cell" scope="col">#id</th>
                                    <th class="table-cell" scope="col">Prenom Nom</th>
                                    <th class="table-cell" scope="col">Pseudo</th>
                                    <th class="table-cell" scope="col">Email</th>
                                    <th class="table-cell" scope="col">Date ban</th>
                                    <th class="table-cell" scope="col">Raison</th>
                                    <th class="table-cell" scope="col">Date deban</th>
                                    <th class="table-cell" scope="col">Définitif</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userInformations = false;

                                if (isset($_POST['show'])) {
                                    $userInformations = ($bdd->query("SELECT id_user, nom, prenom, pseudo, sexe, date_inscription, mail, telephone, date_naissance FROM utilisateur WHERE id_user = {$_POST['show']};"))->fetchAll();
                                }
                                                                                                                                                                                                        try {
                                $queryResponse = $bdd->query("SELECT utilisateur.id_user, CONCAT(utilisateur.prenom, ' ', utilisateur.nom) AS prenom_nom, utilisateur.pseudo, utilisateur.mail, ban.date_ban, ban.raison, ban.date_deban, ban.definitif FROM ban JOIN utilisateur ON ban.id_user = utilisateur.id_user AND (ban.definitif = 1 OR ban.date_deban > NOW());");
                                } catch (PDOException $e){
                                    echo $e->getMessage();
                                }

                                $result = $queryResponse->fetchAll();
                                $idUser;

                                foreach ($result as $row) {
                                    echo '<tr>';
                                    foreach ($row as $key => $info) {
                                        if (gettype($key) === 'string') {
                                            if ($key == 'id_user') {
                                                $idUser = $info;
                                                $info = '#' . $info;
                                            }
                                            echo '<td class="table-cell">' . $info . '</td>';
                                        }
                                    }
                                    echo '<form action="moderation_user.php" method="post">';
                                    echo '<td class="table-cell"><button type="submit" class="btn btn-sm btn-outline-secondary" name=show value=' . $idUser . '>En voir plus</button></td>';
                                    echo '<td class="table-cell"><button type="button" class="btn btn-sm btn-success unban-menu-btn" data-bs-toggle="modal" data-bs-target="#unbanModal" value=' . $idUser . '>Débannir</button></td>';
                                    echo '<td class="table-cell"><button type="button" class="btn btn-sm btn-danger delete-menu-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" name=delete value=' . $idUser . '>Supprimer</button></td>';
                                    echo '</form>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="featurette-divider my-2 <?php if (!isset($_POST['show'])) {echo 'visually-hidden';} ?>">
                <div class="modal fade" id="unbanModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Voulez vous débannir cet utilisateur ?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="moderation_user.php" method="post" class="d-flex justify-content-between">
                                    <button type="submit" id="unban-btn" class="btn btn-success" name="unban-id" value="">Débannir</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Voulez vous supprimer cet utilisateur ?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="moderation_user.php" method="post" class="d-flex justify-content-between">
                                    <button type="submit" id="delete-btn" class="btn btn-danger" name="delete-id" value="">Supprimer</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container rounded bg-white mt-5 mb-5 <?php if (!isset($_POST['show'])) {echo 'visually-hidden';} ?>">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                <span class="font-weight-bold"><?php if ($userInformations) { echo '#' . $userInformations[0]['id_user']; } ?></span>
                                <span class="text-black-50"><?php if ($userInformations) { echo $userInformations[0]['prenom'] . ' ' . $userInformations[0]['nom']; } ?></span>
                                <div class="d-flex justify-content-center">
                                    <button class="nav-btn btn btn-primary btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 mb-3">Supprimer</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 border-right">
                            <form action="moderation_user.php" class="needs-validation" method="post">
                                <div class="p-3 pt-5">
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="labels">Nom</label>
                                            <input type="text" name="lastName" class="form-control" value="<?php if ($userInformations) { echo $userInformations[0]['nom']; } ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Prénom</label>
                                            <input type="text" name="firstName" class="form-control" value="<?php if ($userInformations) { echo $userInformations[0]['prenom']; } ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Pseudo</label>
                                            <input type="text" name="pseudo" class="form-control" value="<?php if ($userInformations) { echo $userInformations[0]['pseudo']; } ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Sexe</label>
                                            <div class="d-sm-flex justify-content-center container ps-0">
                                                <div class="container d-flex align-items-center ps-0">
                                                    <input id="homme" name="sexe" value="homme" type="radio" class="form-check-input border-dark mt-0" required <?php if ($userInformations) { if ($userInformations[0]['sexe'] == 'homme') { echo 'checked';}} ?>>
                                                    <label class="form-check-label labels mx-2" for="homme">Homme</label>
                                                </div>
                                                <div class="container d-flex align-items-center ps-0">
                                                    <input id="femme" name="sexe" value="femme" type="radio" class="form-check-input border-dark mt-0" required <?php if ($userInformations) { if ($userInformations[0]['sexe'] == 'femme') { echo 'checked'; }} ?>>
                                                    <label class="form-check-label labels mx-2" for="femme">Femme</label>
                                                </div>
                                                <div class="container d-flex align-items-center ps-0">
                                                    <input id="autre" name="sexe" value="autre" type="radio" class="form-check-input border-dark mt-0" required <?php if ($userInformations) { if ($userInformations[0]['sexe'] == 'autre') { echo 'checked'; }} ?>>
                                                    <label class="form-check-label labels mx-2" for="autre">Autre</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <label class="labels">Date de naissance</label>
                                            <div class="col-md-4">
                                                <label class="labels">Jour</label>
                                                <input type="text" name="birthday-day" class="form-control" value="<?php if ($userInformations) { echo date('d', strtotime($userInformations[0]['date_naissance'])); } ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="labels">Mois</label>
                                                <input type="text" name="birthday-month" class="form-control" value="<?php if ($userInformations) { echo date('m', strtotime($userInformations[0]['date_naissance'])); } ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="labels">Année</label>
                                                <input type="text" name="birthday-year" class="form-control" value="<?php if ($userInformations) { echo date('Y', strtotime($userInformations[0]['date_naissance']));} ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Email</label>
                                            <input type="text" name="mail" class="form-control" value="<?php if ($userInformations) { echo $userInformations[0]['mail']; } ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Numéro de mobile</label>
                                            <input type="text" name="phone" class="form-control" value="<?php if ($userInformations) { echo $userInformations[0]['telephone']; } ?>">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 my-3" name='id_user' value="<?php if ($userInformations) { echo $userInformations[0]['id_user']; } ?>">Modifier</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <hr class="featurette-divider my-2">
                        <h3 class="text-center">Relation : </h3>
                        <div class="py-3 d-flex justify-content-center">
                            <div class="row w-100">
                                <input class="form-control form-control-white w-100 mb-3" type="text" placeholder="Recherche" aria-label="Search">
                                <div class="col-12 border-bottom border-1">
                                    <div class="col-md-12 overflow-auto menu-oeuvre-2">
                                        <table class="table table-striped table-sm border-top border-1 border-dark">
                                            <tbody>
                                                <tr>
                                                    <td class="table-cell" scope="row">Eric123 (#14572)</td>
                                                    <td class="table-cell">Amis depuis le 14/04/2024</td>
                                                    <td class="table-cell">Inscrit depuis 14/04/2024</td>
                                                    <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Supprimer relation</button></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-cell" scope="row">Eric123 (#14572)</td>
                                                    <td class="table-cell">Amis depuis le 14/04/2024</td>
                                                    <td class="table-cell">Inscrit depuis 14/04/2024</td>
                                                    <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Supprimer relation</button></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-cell" scope="row">Eric123 (#14572)</td>
                                                    <td class="table-cell">Amis depuis le 14/04/2024</td>
                                                    <td class="table-cell">Inscrit depuis 14/04/2024</td>
                                                    <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Supprimer relation</button></td>
                                                </tr>
                                                <tr>
                                                    <td class="table-cell" scope="row">Eric123 (#14572)</td>
                                                    <td class="table-cell">Amis depuis le 14/04/2024</td>
                                                    <td class="table-cell">Inscrit depuis 14/04/2024</td>
                                                    <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Supprimer relation</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="featurette-divider my-2">
                        <h3 class="text-center">Commentaires : </h3>
                        <div class="py-3 d-flex justify-content-center">
                            <div class="row w-100">
                                <div class="col-12 border-bottom border-top border-1 border-black">
                                    <div class="overflow-auto menu-oeuvre-2">
                                        <div>
                                            <p class="m-0 fw-bold">&#x2022; Commentaire #34618 publié le 14/04/2024 à 13:23:34 : Nom de l'oeuvre : 0/5</p>
                                            <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                            <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 mb-3">Supprimer</button>
                                        </div>
                                        <div>
                                            <p class="m-0 fw-bold">&#x2022; Commentaire #34618 publié le 14/04/2024 à 13:23:34 : Nom de l'oeuvre : 0/5</p>
                                            <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                            <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 mb-3">Supprimer</button>
                                        </div>
                                        <div>
                                            <p class="m-0 fw-bold">&#x2022; Commentaire #34618 publié le 14/04/2024 à 13:23:34 : Nom de l'oeuvre : 0/5</p>
                                            <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                            <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 mb-3">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="featurette-divider my-2">
                        <h3 class="text-center">Listes : </h3>

                        <div class="py-3 d-flex justify-content-center">
                            <div class="row w-100">
                                <div class="col-md-12">
                                    <label class="labels">Titre</label>
                                    <input type="text" class="form-control" placeholder="Déja vu" value="">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="labels">Commentaire</label>
                                    <input type="text" class="form-control" value="">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 mb-3">Supprimer</button>
                                </div>
                                <div class="col-md-12 overflow-auto menu-oeuvre-2">
                                    <table class="table table-striped table-sm border-top border-1 border-dark">
                                        <tbody>
                                            <tr>
                                                <td class="table-cell" scope="row">Nom oeuvre</td>
                                                <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                                <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Nom oeuvre</td>
                                                <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                                <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Nom oeuvre</td>
                                                <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                                <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Nom oeuvre</td>
                                                <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                                <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Nom oeuvre</td>
                                                <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                                <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Nom oeuvre</td>
                                                <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                                <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr class="featurette-divider my-2">
                        <div class="py-3 d-flex justify-content-center">
                            <div class="row w-100">
                                <div class="col-md-12">
                                    <label class="labels">Titre</label>
                                    <input type="text" class="form-control" placeholder="À voir" value="">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="labels">Commentaire</label>
                                    <input type="text" class="form-control" value="">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 mb-3">Supprimer</button>
                                </div>
                                <div class="col-md-12 overflow-auto menu-oeuvre-2">
                                    <table class="table table-striped table-sm border-top border-1 border-dark">
                                        <tbody>
                                            <tr>
                                                <td class="table-cell" scope="row">Nom oeuvre</td>
                                                <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                                <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Nom oeuvre</td>
                                                <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                                <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Nom oeuvre</td>
                                                <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                                <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Nom oeuvre</td>
                                                <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                                <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-3 pb-2 mb-4 border-bottom">
                    <h3>Administrateurs : </h3>
                    <ul class="list-group list-group-flush">
                    <?php 
                        foreach($rep_data_user3 as $user) {
                            echo '<li class="list-group-item d-flexalign-items-center justify-content-between">' . $user['nom'].' '.$user['prenom'].' - '.$user['pseudo'].' #'.$user['id_user'].' depuis '.$user['date_inscription'].'</td>';
                            echo '<div class="btn-group me-2">';
                            echo '<button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button><button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>';
                            echo '</div></li>';
                        }
                    ?>
                    </ul>
                </div>
                <div class="text-center justify-content-center mt-5">
                    <button class="btn btn-primary fs-4 mt-3" id="create-admin-btn" type="button">Créer un admin ou utilisateur</button>
                    <br><br><br>
                </div>
                <div class="d-none flex-column align-items-center mt-3" id="create-admin-form">
                    <form action="moderation_user.php" method="POST" class="d-flex flex-column w-50 align-items-center mt-3">
                        <div class="col-12">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="col-12">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        <div class="col-12">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                        </div>
                        <!--ici faire une liste déroumlante pour le role --> 
                        <div class="col-12">
                            <label for="role_user" class="form-label">Role</label>
                            <select class="form-control" id="role_user" name="role_user" required>
                                <option value="utilisateur">utilisateur</option>
                                <option value="admin">admin</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="mail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="mail" name="mail" required>
                        </div>
                        <div class="col-12">
                            <label for="pseudo" class="form-label">Mot de passe</label>
                            <input type="text" class="form-control" id="mdp" name="mdp" required>
                        </div>
                        <button class="btn btn-primary fs-4 mt-3" type="submit" name="create_admin">Créer</button>
                    </form>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const createAdminBtn = document.getElementById('create-admin-btn');
                        const createAdminForm = document.getElementById('create-admin-form');

                        createAdminBtn.addEventListener('click', function() {
                            createAdminForm.classList.toggle('d-none'); 
                            createAdminForm.scrollIntoView({ behavior: 'smooth' });
                        });
                    });
                </script>

            </main>
        </div>
    </div>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../inc/js/moderation_user.js"></script>
</body>

</html>