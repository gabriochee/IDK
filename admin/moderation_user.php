<?php require_once('../inc/php/access.php'); ?>
<?php require_once('../inc/library/fpdf/function_fpdf_admin.php'); ?>
<?php require_once('../inc/php/function_display_moderation_user.php'); ?>
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
                <div class="container border border-black rounded-2 border-2 mt-3">

                    <h1 class="text-center mt-4">Modération</h1>
                    <p class="text-end mb-0">Administrateur connecté : <?php echo $res_display_admin_co['prenom'] . ' ' . $res_display_admin_co['nom']; ?></p>
                    <p class="text-end mt-0"><?php echo date('o-m-d H:i:s'); ?></p>
                    <hr class="featurette-divider my-2">

                    <div class="col-md-12 overflow-auto mt-4">
                        <div class="d-md-flex">
                            <h3 class="w-25 text-start">Utilisateurs :</h3>
                            <input class="form-control form-control-white w-100 mb-3" type="text" placeholder="Recherche" aria-label="Search">
                        </div>
                        <div class="overflow-auto menu-oeuvre-2" style="max-height: 300px;">
                            <table class="table table-striped table-sm border border-3 border-dark" id="users-table">
                                <tbody class="table-dark">
                                    <?php
                                    foreach ($res_display_user as $user) {
                                        echo '<tr><td class="table-cell text-start">#' . $user['id_user'] . '    ' . $user['pseudo'] . ' (' . $user['prenom'] . ' ' . $user['nom'] . ')</td>';
                                        echo '<td class="table-cell w-25"><button type="submit" data-id="' . $user['id_user'] . '" class="btn btn-warning w-100 fs-6 show">En voir plus</button></td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="featurette-divider my-2">

                    <div class="col-md-12 overflow-auto mt-4">
                        <div class="d-md-flex">
                            <h3 class="w-25 text-start">Utilisateurs ban :</h3>
                            <input class="form-control form-control-white w-100 mb-3" type="text" placeholder="Recherche" aria-label="Search">
                        </div>
                        <div class="overflow-auto menu-oeuvre-2" style="max-height: 300px;">
                            <table class="table table-striped table-sm border border-3 border-dark" id="users-table">
                                <tbody class="table-dark">
                                    <?php
                                    foreach ($res_display_user_ban as $user_ban) {
                                        echo '<tr><td class="table-cell text-start">#' . $user_ban['id_user'] . '    ' . $user_ban['pseudo'] . ' (' . $user_ban['prenom'] . ' ' . $user_ban['nom'] . ')</td>';
                                        echo '<td class="table-cell w-25"><button type="submit" data-id="' . $user_ban['id_user'] . '" class="btn btn-warning w-100 fs-6 show">En voir plus</button></td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="featurette-divider my-2">

                    <div class="col-md-12 overflow-auto mt-4">
                        <div class="d-md-flex">
                            <h3 class="text-start w-25">Administrateur :</h3>
                            <div class="d-flex w-100">
                                <input class="w-100 form-control form-control-white mb-3 me-3" type="text" placeholder="Recherche" aria-label="Search">
                                <button class="w-25 btn btn-warning border-dark d-flex m-auto justify-content-center mb-3" data-bs-toggle="modal" data-bs-target="#create-admin">Crée un admin</button>
                            </div>
                        </div>
                        <div class="overflow-auto menu-oeuvre-2" style="max-height: 300px;">
                            <table class="table table-striped table-sm border border-3 border-dark" id="users-table">
                                <tbody class="table-dark">
                                    <?php
                                    foreach ($res_display_admin as $admin) {
                                        echo '<tr><td class="table-cell text-start">#' . $admin['id_user'] . '    ' . $admin['pseudo'] . ' (' . $admin['prenom'] . ' ' . $admin['nom'] . ')</td>';
                                        echo '<td class="table-cell w-25"><button type="submit" data-id="' . $admin['id_user'] . '" class="btn btn-warning w-100 fs-6 show">En voir plus</button></td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="create-admin" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Crée un administrateur</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="moderation_user.php" method="POST" class="d-flex flex-column w-100 align-items-center mt-3">
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
                                        <div class="col-12">
                                            <label for="sexe" class="form-label">Sexe</label>
                                            <select class="form-select" id="sexe-admin" name="sexe-admin" required>
                                                <option value="homme">Homme</option>
                                                <option value="femme">Femme</option>
                                                <option value="autre">Autre</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="date_naissance" class="form-label">Date de naissance</small></label>
                                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="mail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="mail" name="mail" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="phone" class="form-label">Numéro de téléphone</label>
                                            <input type="tel" class="form-control" id="phone-admin" name="phone-admin" pattern="{,100}" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="pseudo" class="form-label">Mot de passe</label>
                                            <input type="password" class="form-control" id="mdp" name="mdp" required>
                                        </div>
                                        <button class="btn btn-sm btn-warning fs-4 mt-3 w-100" type="submit" name="push_data_admin">Créer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center gap-5 d-none" id="user">

                        <hr class="featurette-divider my-2">
                        <div class="col-md-4">
                            <div class="card card-profile text-center border-0" style="background-color: transparent;">
                                <div class="card-body">
                                    <img id="user-photo" src="" alt="Photo de l'utilisateur" class="mb-3 card-img-top img-fluid rounded-circle">
                                    <h3 id="user-pseudo-id" class="card-title"></h3>
                                    <h4 id="user-fullname" class="card-text text-start my-0"></h4>
                                    <p id="user-registration-date" class="card-text text-start my-0"></p>
                                    <p id="last-connexion" class="card-text text-start my-0"></p>
                                    <span id="number-of-friends" class="badge bg-secondary my-3"></span>
                                    <p id="average-friends-age" class="card-text text-start my-0"></p>
                                    <p id="majority-friends-sexe" class="card-text text-start my-0"></p>
                                    <p id="relation-pending" class="card-text text-start my-0"></p>
                                    <p id="relation-refused" class="card-text text-start my-0"></p>
                                    <p id="number-of-list-public" class="card-text text-start my-0"></p>
                                    <p id="number-of-list-private" class="card-text text-start my-0"></p>
                                    <p id="number-of-list-only-friend" class="card-text text-start my-0"></p>
                                    <p id="number-of-opinion-public" class="card-text text-start my-0"></p>
                                    <p id="number-of-opinion-private" class="card-text text-start my-0"></p>
                                    <p id="ban" class="card-text text-start my-0"></p>
                                </div>
                            </div>
                            <form method="POST" enctype="multipart/form-data" action="../inc/php/function_display_moderation_user.php" class="mt-2">
                                <div class="mb-3">
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <input type="hidden" name="id_user_for_img" id="id_user_for_img">
                                <button type="submit" name="submit_img" class="btn btn-warning border-dark w-100">Modifier photo profil</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="" class="needs-validation" method="POST">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="firstName" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-ZÀ-ÿ0-9.' -]{2,40}" required>
                                        <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="lastName" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-ZÀ-ÿ0-9.' -]{2,40}" required>
                                        <div class="invalid-feedback">Veuillez fournir un nom valide.</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="username" class="form-label">Pseudo</label>
                                        <input type="text" class="form-control" id="username" name="username" pattern="{,100}" required>
                                        <div class="invalid-feedback">Veuillez fournir un pseudo existant valide.</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="sexe" class="form-label">Sexe</label>
                                        <select class="form-select" id="sexe" name="sexe" required>
                                            <option value="Homme">Homme</option>
                                            <option value="Femme">Femme</option>
                                            <option value="Autre">Autre</option>
                                        </select>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <div class="col-3">
                                            <label for="birthday-day" class="form-label">Jour</label>
                                            <input type="number" class="form-control" id="birthday-day" name="birthday-day" min="1" max="31">
                                            <div class="invalid-feedback">Veuillez fournir un jour valide.</div>
                                        </div>
                                        <div class="col-4">
                                            <label for="birthday-month" class="form-label">Mois</label>
                                            <select class="form-control" name="birthday-month" id="birthday-month">
                                                <option disabled value></option>
                                                <option value="01">janvier</option>
                                                <option value="02">février</option>
                                                <option value="03">mars</option>
                                                <option value="04">avril</option>
                                                <option value="05">mai</option>
                                                <option value="06">juin</option>
                                                <option value="07">juillet</option>
                                                <option value="08">août</option>
                                                <option value="09">septembre</option>
                                                <option value="10">octobre</option>
                                                <option value="11">novembre</option>
                                                <option value="12">décembre</option>
                                            </select>
                                            <div class="invalid-feedback">Veuillez fournir un mois valide.</div>
                                        </div>

                                        <div class="col-3">
                                            <label for="birthday-year" class="form-label">Année</label>
                                            <input type="number" class="form-control" name="birthday-year" id="birthday-year" min="1900" max="<?php echo (date("Y")); ?>">
                                            <div class="invalid-feedback">Veuillez fournir une année valide.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" pattern="{,100}">
                                        <div class="invalid-feedback">Veuillez fournir un email valide.</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="phone" class="form-label">Numéro de téléphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" pattern="{,100}">
                                        <div class="invalid-feedback">Veuillez fournir un numéro de téléphone valide (10 chiffres).</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="sexe" class="form-label">Newsletter</label>
                                        <select class="form-select" name="newsletter" id="newsletter" required>
                                            <option value="1">J'accepte de reçevoir la Newsletter</option>
                                            <option value="0">Je refuse de recevoir la Newsletter</option>
                                        </select>
                                    </div>
                                    <button class="w-100 btn btn-warning border-dark" type="submit" name="id_user" id="update-user-btn">Mettre à jour</button>
                                </div>
                            </form>

                            <div class="d-flex">
                                <form action="moderation_user.php" method="POST" class="w-50 me-1">
                                    <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mt-1" type="submit" id="export" name="export">Exporter données</button>
                                </form>
                                <form class="w-50">
                                    <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mt-1" id="new-mdp-btn" type="button">Changer mot de passe</button>
                                </form>
                            </div>
                            <div class="d-flex flex-column align-items-center mt-8">
                                <?php
                                if (isset($_GET['2mdp0'])) {
                                    echo "<div class='alert alert-danger' role='alert'>Les deux MDP ne correspondent pas</div>";
                                }
                                if (isset($_GET['ex_mdp0'])) {
                                    echo "<div class='alert alert-danger' role='alert'>l'ancien MDP est faux</div>";
                                }
                                if (isset($_GET['mdp1'])) {
                                    echo "<div class='alert alert-danger' role='alert'>Le changement de MDP a été effectué avec succès</div>";
                                }
                                if (isset($_GET['mdp0'])) {
                                    echo "<div class='alert alert-danger' role='alert'>Le MDP ne s'est pas modifié</div>";
                                }
                                ?>
                                <form action="moderation_user.php" id="new-mdp-form" class="d-none d-flex flex-column w-100 align-items-center mt-3" method="POST">
                                    <div class="col-12">
                                        <label for="current-password" class="form-label">Mot de passe actuel</label>
                                        <input type="password" class="form-control" id="current-password" name="current-password" required>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <label for="new-password" class="form-label">Nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="new-password" name="new-password" required>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <label for="confirm-password" class="form-label">Confirmer le nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                                    </div>
                                    <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center my-3" id="update-password-btn" type="submit" name="update-pass">Mettre à jour le mot de passe</button>
                                </form>
                            </div>

                            <div class="d-flex">
                                <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mt-1 me-1" id="ban-menu-btn" data-bs-toggle="modal" data-bs-target="#banModal">Bannir</button>

                                <div class="modal fade" id="banModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Voulez vous bannir cet utilisateur ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="moderation_user.php" method="POST">
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
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <button type="submit" id="ban-btn" class="btn btn-danger" name="ban-id">Bannir</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="unbanModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Voulez vous débannir cet utilisateur ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="moderation_user.php" method="POST" class="d-flex justify-content-between">
                                                    <button type="submit" id="unban-btn" class="btn btn-success" name="unban-id" value="">Débannir</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mb-3 mt-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer</button>

                                <div class="modal fade" id="deleteModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Voulez vous supprimer cet utilisateur ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="moderation_user.php" method="POST" class="d-flex justify-content-between">
                                                    <button type="submit" id="delete-btn" class="btn btn-danger" name="delete-id" value="">Supprimer</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll('.show');
            const content = document.getElementById('user');
            const userId = document.getElementById('id_user')

            const userPhoto = document.getElementById('user-photo');
            const userPseudoId = document.getElementById('user-pseudo-id');
            const userFullname = document.getElementById('user-fullname');
            const userRegistrationDate = document.getElementById('user-registration-date');
            const lastConnexion = document.getElementById('last-connexion');
            const numberOfFriends = document.getElementById('number-of-friends');
            const averageFriendsAge = document.getElementById('average-friends-age');
            const majorityFriendsSexe = document.getElementById('majority-friends-sexe');
            const relationWaiting = document.getElementById('relation-pending');
            const relationRefused = document.getElementById('relation-refused');
            const numberOfListPublic = document.getElementById('number-of-list-public');
            const numberOflistPrivate = document.getElementById('number-of-list-private');
            const numberOflistOnlyFriend = document.getElementById('number-of-list-only-friend');
            const numberOfOpinionPublic = document.getElementById('number-of-opinion-public');
            const numberOfOpinionPrivate = document.getElementById('number-of-opinion-private');
            const ban = document.getElementById('ban');
            const hiddenForImgUpdate =document.getElementById('id_user_for_img');
            const firstNameInput = document.getElementById('firstName');
            const lastNameInput = document.getElementById('lastName');
            const usernameInput = document.getElementById('username');
            const birthdayDayInput = document.getElementById('birthday-day');
            const birthdayMonthSelect = document.getElementById('birthday-month');
            const birthdayYearInput = document.getElementById('birthday-year');
            const sexeSelect = document.getElementById('sexe');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const newsletterSelect = document.getElementById('newsletter');

            const newMdpBtn = document.getElementById('new-mdp-btn');
            const newMdpForm = document.getElementById('new-mdp-form');
            const banBtn = document.getElementById('ban-btn');
            const banMenuBtn = document.getElementById('ban-menu-btn');
            const deleteBtn = document.getElementById('delete-btn');
            const unbanBtn = document.getElementById('unban-btn');
            const updateBtn = document.getElementById('update-user-btn');
            const bannedUsers = <?php echo json_encode($res_display_user_ban); ?>;
            const exportData = document.getElementById('export');

            newMdpBtn.addEventListener('click', function() {
                newMdpForm.classList.toggle('d-none');
                newMdpForm.scrollIntoView({
                    behavior: 'smooth'
                });
            });

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');

                    fetch(`../inc/php/function_moderation_user.php?id=${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                let isBanned = false;

                                userPhoto.src = `../inc/img/user_img/${data.user.photo_utilisateur}?${Date.now()}`;
                                userPseudoId.innerHTML = `<b>${data.user.pseudo} (#${data.user.id_user})</b>`;
                                userFullname.innerHTML = `<b>${data.user.nom} ${data.user.prenom}</b>`;
                                userRegistrationDate.innerHTML = `<b>Inscrit depuis :</b> ${data.user.date_inscription}`;
                                lastConnexion.innerHTML = `<b>Dèrnière connexion :</b> ${data.user.derniere_connexion}`;
                                numberOfFriends.textContent = `${data.user.nombre_amis} amis`;
                                averageFriendsAge.innerHTML = `<b>Moyenne d'age d'amis :</b> ${data.user.moyenne_age_ami}`;
                                majorityFriendsSexe.innerHTML = `<b>Genre majoritaire de relations :</b> ${data.user.majorite_genre_ami}`;
                                relationWaiting.innerHTML = `<b>Demande d'amis en attente :</b> ${data.user.nombre_demandes_amis}`;
                                relationRefused.innerHTML = `<b>Demande d'amis refusées :</b> ${data.user.nombre_demandes_refusees}`;
                                numberOfListPublic.innerHTML = `<b>Nombres de listes publiques :</b> ${data.user.nombre_listes_publique}`;
                                numberOflistPrivate.innerHTML = `<b>Nombres de listes privées :</b> ${data.user.nombre_listes_privee}`;
                                numberOflistOnlyFriend.innerHTML = `<b>Nombres de listes uniquement pour amis :</b> ${data.user.nombre_listes_only_amis}`;
                                numberOfOpinionPublic.innerHTML = `<b>Nombres d'avis publiques :</b> ${data.user.nombre_avis_publique}`;
                                numberOfOpinionPrivate.innerHTML = `<b>Nombres d'avis privées :</b> ${data.user.nombre_avis_privee}`;
                                hiddenForImgUpdate.value = data.user.id_user;
                                banBtn.value = data.user.id_user;
                                unbanBtn.value = data.user.id_user;
                                deleteBtn.value = data.user.id_user;
                                updateBtn.value = data.user.id_user;
                                exportData.value = data.user.id_user;

                                for (const user of bannedUsers) {
                                    if (Object.values(user).includes(data.user.id_user)) {
                                        ban.innerHTML = `<b>Banni du ${data.user.date_ban} jusqu'au ${data.user.date_deban} pour motif :</b>  ${data.user.raison}`;
                                        banMenuBtn.setAttribute('data-bs-target', "#unbanModal");
                                        banMenuBtn.innerText = "Débannir";
                                        isBanned = true;
                                    }
                                }

                                if (!isBanned) {
                                    ban.classList.add('d-none');
                                    banMenuBtn.setAttribute('data-bs-target', "#banModal");
                                    banMenuBtn.innerText = "Bannir";
                                }

                                firstNameInput.value = data.user.prenom;
                                lastNameInput.value = data.user.nom;
                                usernameInput.value = data.user.pseudo;


                                const dateNaissance = data.user.date_naissance.split("-");
                                birthdayDayInput.value = dateNaissance[2];
                                for (let i = 0; i < birthdayMonthSelect.options.length; i++) {
                                    if (birthdayMonthSelect.options[i].value === String(dateNaissance[1])) {
                                        birthdayMonthSelect.options[i].selected = true;
                                        break;
                                    }
                                }
                                birthdayYearInput.value = dateNaissance[0];

                                console.log(birthdayYearInput);
                                for (let i = 0; i < sexeSelect.options.length; i++) {
                                    if (sexeSelect.options[i].value === String(data.user.sexe)) {
                                        sexeSelect.options[i].selected = true;
                                        break;
                                    }
                                }
                                emailInput.value = data.user.mail;
                                phoneInput.value = data.user.telephone;
                                for (let i = 0; i < newsletterSelect.options.length; i++) {
                                    if (newsletterSelect.options[i].value === String(data.user.statut_newsletter)) {
                                        newsletterSelect.options[i].selected = true;
                                        break;
                                    }
                                }
                                userId.value = data.user.id_user;

                                content.classList.remove('d-none');
                                content.scrollIntoView({
                                    behavior: 'smooth'
                                });
                            } else {
                                console.error('Erreur:', data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Erreur lors de la récupération des informations de l\'utilisateur', error);
                        });
                });
            });
        });
    </script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../inc/js/moderation_user.js"></script>
</body>

</html>