<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/style/style.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>

<body id="backoffice_moderation_user" class="backoffice">
    <?php require('../inc/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require('../inc/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive mt-4">
                    <h3 class="mb-3">Utilisateurs : </h3>
                    <?php
                    require('../inc/php/db.php');
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['id_user'])) {
                            try {
                                $result = $bdd->query("UPDATE UTILISATEUR SET nom = '{$_POST['lastName']}', prenom = '{$_POST['firstName']}', pseudo = '{$_POST['pseudo']}', sexe = '{$_POST['sexe']}', date_naissance = \"{$_POST['birthday-year']}-{$_POST['birthday-month']}-{$_POST['birthday-day']}\", mail = '{$_POST['mail']}', telephone = '{$_POST['phone']}' WHERE id_user = {$_POST['id_user']};");
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                        }
                    }
                    ?>
                    <input class="form-control form-control-white w-100 mb-3" type="text" placeholder="Recherche" aria-label="Search">
                    <div class="overflow-auto menu-oeuvre-2">
                        <table class="table table-striped table-sm border border-3 border-dark ">
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
                                    $userInformations = ($bdd->query("SELECT id_user, nom, prenom, pseudo, sexe, date_inscription, mail, telephone, date_naissance FROM UTILISATEUR WHERE id_user = {$_POST['show']};"))->fetchAll();
                                }

                                $queryResponse = $bdd->query("SELECT id_user, CONCAT(prenom, ' ', nom) as prenom_nom, pseudo, sexe, date_inscription, mail, date_naissance FROM UTILISATEUR;");

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
                                    echo '<td class="table-cell"><button type="submit" class="btn btn-sm btn-warning" name=ban value=' . $idUser . '>Bannir</button></td>';
                                    echo '<td class="table-cell"><button type="submit" class="btn btn-sm btn-danger" name=delete value=' . $idUser . '>Supprimer</button></td>';
                                    echo '</form>';
                                    echo '</tr>';
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="featurette-divider my-2">

                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                <span class="font-weight-bold"><?php if ($userInformations) {
                                                                    echo '#' . $userInformations[0]['id_user'];
                                                                } ?></span>
                                <span class="text-black-50"><?php if ($userInformations) {
                                                                echo $userInformations[0]['prenom'] . ' ' . $userInformations[0]['nom'];
                                                            } ?></span>
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
                                            <input type="text" name="lastName" class="form-control" value="<?php if ($userInformations) {
                                                                                                echo $userInformations[0]['nom'];
                                                                                            } ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Prénom</label>
                                            <input type="text" name="firstName" class="form-control" value="<?php if ($userInformations) {
                                                                                                echo $userInformations[0]['prenom'];
                                                                                            } ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Pseudo</label>
                                            <input type="text" name="pseudo" class="form-control" value="<?php if ($userInformations) {
                                                                                                echo $userInformations[0]['pseudo'];
                                                                                            } ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Sexe</label>
                                            <div class="d-sm-flex justify-content-center container ps-0">
                                                <div class="container d-flex align-items-center ps-0">
                                                    <input id="homme" name="sexe" value="homme" type="radio" class="form-check-input border-dark mt-0" required <?php if ($userInformations) {
                                                                                                                                                        if ($userInformations[0]['sexe'] == 'homme') {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    } ?>>
                                                    <label class="form-check-label labels mx-2" for="homme">Homme</label>
                                                </div>
                                                <div class="container d-flex align-items-center ps-0">
                                                    <input id="femme" name="sexe" value="femme" type="radio" class="form-check-input border-dark mt-0" required <?php if ($userInformations) {
                                                                                                                                                        if ($userInformations[0]['sexe'] == 'femme') {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    } ?>>
                                                    <label class="form-check-label labels mx-2" for="femme">Femme</label>
                                                </div>
                                                <div class="container d-flex align-items-center ps-0">
                                                    <input id="autre" name="sexe" value="autre" type="radio" class="form-check-input border-dark mt-0" required <?php if ($userInformations) {
                                                                                                                                                        if ($userInformations[0]['sexe'] == 'autre') {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        }
                                                                                                                                                    } ?>>
                                                    <label class="form-check-label labels mx-2" for="autre">Autre</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <label class="labels">Date de naissance</label>
                                            <div class="col-md-4">
                                                <label class="labels">Jour</label>
                                                <input type="text" name="birthday-day" class="form-control" value="<?php if ($userInformations) {
                                                                                                    echo date('d', strtotime($userInformations[0]['date_naissance']));
                                                                                                } ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="labels">Mois</label>
                                                <input type="text" name="birthday-month" class="form-control" value="<?php if ($userInformations) {
                                                                                                    echo date('m', strtotime($userInformations[0]['date_naissance']));
                                                                                                } ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="labels">Année</label>
                                                <input type="text" name="birthday-year" class="form-control" value="<?php if ($userInformations) {
                                                                                                    echo date('Y', strtotime($userInformations[0]['date_naissance']));
                                                                                                } ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Email</label>
                                            <input type="text" name="mail" class="form-control" value="<?php if ($userInformations) {
                                                                                                echo $userInformations[0]['mail'];
                                                                                            } ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Numéro de mobile</label>
                                            <input type="text" name="phone" class="form-control" value="<?php if ($userInformations) {
                                                                                                echo $userInformations[0]['telephone'];
                                                                                            } ?>">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 my-3" name='id_user' value="<?php if ($userInformations) {
                                                                                                                                                                                        echo $userInformations[0]['id_user'];
                                                                                                                                                                                    } ?>">Modifier</button>
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
            </main>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>