<?php require_once('../inc/php/access.php'); ?>
<?php require_once('../inc/php/affichage_data_user.php'); ?>
<?php require_once('../inc/library/fpdf/function_fpdf_admin.php'); ?>
<?php require_once('../inc/php/function_create_admin.php'); ?>


<?php
// admin connecter GOOD
$req_display_admin_co = $bdd->prepare("SELECT id_user, nom, prenom, pseudo FROM utilisateur WHERE id_user = :id_user;");
$req_display_admin_co->execute(array("id_user" => $_SESSION['id_user']));
$res_display_admin_co = $req_display_admin_co->fetch();

// rechercher un user pas ban pas delete pas admin
// afficher tout les user pas ban pas delete pas admin GOOD
$req_display_user = $bdd->prepare("SELECT id_user, nom, prenom, pseudo FROM utilisateur WHERE role_user = 'utilisateur' AND supprime != 1;");
$req_display_user->execute();
$res_display_user = $req_display_user->fetchAll();
$res_display_user = array_reverse($res_display_user);
// rechercher un user ban pas admin pas delete
// afficher tout les user ban pas admin pas delete GOOD
$req_display_user_ban = $bdd->prepare("SELECT utilisateur.id_user, nom, prenom, pseudo FROM utilisateur INNER JOIN ban ON utilisateur.id_user = ban.id_user WHERE utilisateur.supprime != 1;");
$req_display_user_ban->execute();
$res_display_user_ban = $req_display_user_ban->fetchAll();
$res_display_user_ban = array_reverse($res_display_user_ban);
// rechercher un admin pas delete
// afficher tout les admin delete
$req_display_admin = $bdd->prepare("SELECT id_user, nom, prenom, pseudo FROM utilisateur WHERE role_user = 'admin' AND supprime != 1;");
$req_display_admin->execute();
$res_display_admin = $req_display_admin->fetchAll();
$res_display_admin = array_reverse($res_display_admin);
// ajouter un admin

// lors du clique sur en voir plus afficher les infos dans le form 
// modifier infos dans la base 
// ban/deban 
// export données 
// supprimer user 


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
<body id="backoffice_moderation_user" class="backoffice">
    <?php require_once('../inc/components/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/components/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container border border-black rounded-2 border-2 mt-3">
                    
                    <h1 class="text-center mt-4">Modération</h1>
                    <p class="text-end mb-0">Administrateur connecté : <?php echo $res_display_admin_co['prenom'] .' '. $res_display_admin_co['nom'];?></p>
                    <p class="text-end mt-0"><?php echo date('o-m-d H:i:s'); ?></p>
                    <hr class="featurette-divider my-2">

                    <div class="col-md-12 overflow-auto mt-4" style="max-height: 300px;">
                        <div class="d-flex">
                            <h3 class="w-25 text-start">Utilisateurs :</h3>
                            <input class="form-control form-control-white w-100 mb-3" type="text" placeholder="Recherche" aria-label="Search">
                        </div>
                        <div class="overflow-auto menu-oeuvre-2">
                            <table class="table table-striped table-sm border border-3 border-dark" id="users-table">
                                <tbody class="table-dark"> 
                                    <?php
                                        foreach($res_display_user as $user) {
                                            echo '<tr><td class="table-cell text-start">#' .$user['id_user']. '    ' .$user['pseudo']. ' (' .$user['prenom'].$user['nom']. ')</td>';
                                            echo '<td class="table-cell w-25"><button type="submit" name="" class="btn btn-warning w-100 fs-6">En voir plus</button></td></tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="featurette-divider my-2">

                    <div class="col-md-12 overflow-auto mt-4" style="max-height: 300px;">
                        <div class="d-flex">
                            <h3 class="w-25 text-start">Utilisateurs ban :</h3>
                            <input class="form-control form-control-white w-100 mb-3" type="text" placeholder="Recherche" aria-label="Search">
                        </div>
                        <div class="overflow-auto menu-oeuvre-2">
                            <table class="table table-striped table-sm border border-3 border-dark" id="users-table">
                                <tbody class="table-dark"> 
                                    <?php
                                        foreach($res_display_user_ban as $user_ban) {
                                            echo '<tr><td class="table-cell text-start">#' .$user_ban['id_user']. '    ' .$user_ban['pseudo']. ' (' .$user_ban['prenom'].$user_ban['nom']. ')</td>';
                                            echo '<td class="table-cell w-25"><button type="submit" name="" class="btn btn-warning w-100 fs-6">En voir plus</button></td></tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="featurette-divider my-2">

                    <div class="col-md-12 overflow-auto mt-4" style="max-height: 300px;">
                        <div class="d-flex">
                            <h3 class="text-start w-25">Administrateur :</h3>
                            <div class="d-flex w-100">
                                <input class="w-100 form-control form-control-white mb-3 me-3" type="text" placeholder="Recherche" aria-label="Search">
                                <button class="w-25 btn btn-warning border-dark d-flex m-auto justify-content-center mb-3">Crée un admin</button>
                            </div>
                        </div>
                        <div class="overflow-auto menu-oeuvre-2">
                            <table class="table table-striped table-sm border border-3 border-dark" id="users-table">
                                <tbody class="table-dark"> 
                                    <?php
                                        foreach($res_display_admin as $admin) {
                                            echo '<tr><td class="table-cell text-start">#' .$admin['id_user']. '    ' .$admin['pseudo']. ' (' .$admin['prenom'].$admin['nom']. ')</td>';
                                            echo '<td class="table-cell w-25"><button type="submit" name="" class="btn btn-warning w-100 fs-6">En voir plus</button></td></tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="featurette-divider my-2">

                    <div class="row justify-content-center gap-5">
                        <div class="col-md-4">
                            <div class="card card-profile text-center border-0" style="background-color: transparent;">
                                <div class="card-body">
                                    <img src="../../inc/img/user_img/<?php echo htmlspecialchars($rep_data_user1['photo_utilisateur']); ?>?<?php echo time(); ?>" alt="Photo de l'utilisateur" class="mb-3 card-img-top img-fluid rounded-circle">                            <h4 class="card-title"><?php echo $rep_data_user1['pseudo'] .' (#'. $rep_data_user1['id_user'] .')'; ?></h4>
                                    <p class="card-text text-start my-0"><?php echo $rep_data_user1['nom'] .' '. $rep_data_user1['prenom']; ?></p>
                                    <p class="card-text text-start my-0">Inscrit depuis : <?php echo $rep_data_user1['date_inscription']; ?></p>
                                    <span class="badge bg-secondary mt-3"><?php echo $rep_data_user2['count(*)']; ?> amis</span>
                                </div>
                            </div>
                            <form method="POST" enctype="multipart/form-data" action="parameters.php" class="mt-2">
                                <div class="mb-3">
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <button type="submit" name="submit_img" class="btn btn-warning border-dark w-100">Modifier photo profil</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="parameters.php" class="needs-validation" method="POST">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="firstName" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-ZÀ-ÿ0-9.' -]{2,40}" required value="<?php if (isset($rep_data_user1['prenom'])) {echo $rep_data_user1['prenom'];} ?>">
                                        <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="lastName" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-ZÀ-ÿ0-9.' -]{2,40}" required value="<?php if (isset($rep_data_user1['nom'])) {echo $rep_data_user1['nom'];} ?>">
                                        <div class="invalid-feedback">Veuillez fournir un nom valide.</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="username" class="form-label">Pseudo</label>
                                        <input type="text" class="form-control" id="username" name="username" pattern="{,100}" required value="<?php if (isset($rep_data_user1['pseudo'])) {echo $rep_data_user1['pseudo'];} ?>">
                                        <div class="invalid-feedback">Veuillez fournir un pseudo existant valide.</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="sexe" class="form-label">Sexe</label>
                                        <select class="form-select" id="sexe" name="sexe" required value="<?php if (isset($rep_data_user1['sexe'])) {echo $rep_data_user1['sexe'];} ?>">
                                            <option value="homme">Homme</option>
                                            <option value="femme">Femme</option>
                                            <option value="autre">Autre</option>
                                        </select>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <div class="col-3">
                                            <label for="birthday-day" class="form-label">Jour</label>
                                            <input type="number" class="form-control" id="birthday-day" name="birthday-day" min="1" max="31" value="<?php if (isset($rep_data_user1['date_naissance'])) {echo date('d', strtotime($rep_data_user1['date_naissance']));} ?>">
                                            <div class="invalid-feedback">Veuillez fournir un jour valide.</div>
                                        </div>
                                        <div class="col-4">
                                            <label for="birthday-month" class="form-label">Mois</label>
                                            <select class="form-control" name="birthday-month" id="birdthday-month">
                                                <option disabled <?php if (!isset($rep_data_user1['date_naissance'])){ echo 'selected';} ?> value></option>
                                                <option value="01" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "01"){ echo 'selected';} ?>>janvier</option>
                                                <option value="02" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "02"){ echo 'selected';} ?>>février</option>
                                                <option value="03" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "03"){ echo 'selected';} ?>>mars</option>
                                                <option value="04" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "04"){ echo 'selected';} ?>>avril</option>
                                                <option value="05" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "05"){ echo 'selected';} ?>>mai</option>
                                                <option value="06" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "06"){ echo 'selected';} ?>>juin</option>
                                                <option value="07" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "07"){ echo 'selected';} ?>>juillet</option>
                                                <option value="08" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "08"){ echo 'selected';} ?>>août</option>
                                                <option value="09" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "09"){ echo 'selected';} ?>>septembre</option>
                                                <option value="10" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "10"){ echo 'selected';} ?>>octobre</option>
                                                <option value="11" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "11"){ echo 'selected';} ?>>novembre</option>
                                                <option value="12" <?php if (isset($rep_data_user1['date_naissance']) && date('m', strtotime($rep_data_user1['date_naissance'])) == "12"){ echo 'selected';} ?>>décembre</option>
                                            </select>
                                            <div class="invalid-feedback">Veuillez fournir un mois valide.</div>
                                        </div>

                                        <div class="col-3">
                                            <label for="birthday-year" class="form-label">Année</label>
                                            <input type="number" class="form-control" name="birthday-year" id="birdthday-year" min="1900" max="<?php echo (date("Y")); ?>" value="<?php if (isset($rep_data_user1['date_naissance'])) {echo date('Y', strtotime($rep_data_user1['date_naissance']));} ?>">
                                            <div class="invalid-feedback">Veuillez fournir une année valide.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" pattern="{,100}" required value="<?php if (isset($rep_data_user1['mail'])) {echo $rep_data_user1['mail'];} ?>">
                                        <div class="invalid-feedback">Veuillez fournir un email valide.</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="phone" class="form-label">Numéro de téléphone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" pattern="{,100}" required 
                                            value="<?php if (isset($rep_data_user1['telephone'])) {echo $rep_data_user1['telephone'];} ?>">
                                        <div class="invalid-feedback">Veuillez fournir un numéro de téléphone valide (10 chiffres).</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="sexe" class="form-label">Newsletter</label>
                                        <select class="form-select" name="newsletter" required>
                                            <option value="1" <?php if (isset($rep_data_user1['statut_newsletter']) && $rep_data_user1['statut_newsletter'] == "1"){ echo 'selected';} ?>>J'accepte de reçevoir la Newsletter</option>
                                            <option value="0" <?php if (isset($rep_data_user1['statut_newsletter']) && $rep_data_user1['statut_newsletter'] == "0"){ echo 'selected';} ?>>Je refuse de recevoir la Newsletter</option>
                                        </select>
                                    </div>
                                    <button class="w-100 btn btn-warning border-dark" id="signin-btn" type="submit" name="send">Mettre à jour</button>
                                </div>
                            </form>

                            <div class="d-flex">
                                <form action="parameters.php" method="POST" class="w-50 me-1">
                                    <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mt-1" id="signin-btn" type="submit" name="export">Exporter données</button>
                                </form>
                                <form class="w-50">
                                    <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mt-1" id="new-mdp-btn" type="button">Changer mot de passe</button>
                                </form>
                            </div>
                            <div class="d-flex flex-column align-items-center mt-8">                    
                                <?php
                                    if(isset($_GET['2mdp0'])) {echo "<div class='alert alert-danger' role='alert'>Les deux MDP ne correspondent pas</div>";}
                                    if(isset($_GET['ex_mdp0'])) {echo "<div class='alert alert-danger' role='alert'>l'ancien MDP est faux</div>";}
                                    if(isset($_GET['mdp1'])) {echo "<div class='alert alert-danger' role='alert'>Le changement de MDP a été effectué avec succès</div>";}
                                    if(isset($_GET['mdp0'])) {echo "<div class='alert alert-danger' role='alert'>Le MDP ne s'est pas modifié</div>";}
                                ?>
                                <form action="parameters.php" id="new-mdp-form" class="d-none d-flex flex-column w-100 align-items-center mt-3" method="POST">
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
                                <form class="w-50 me-1">
                                    <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mt-1" id="" type="submit" name="">Bannir</button>
                                </form>
                                <form class="w-50">
                                    <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mb-3 mt-1" id="" type="submit" name="">Supprimer</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const newMdpBtn = document.getElementById('new-mdp-btn');
        const newMdpForm = document.getElementById('new-mdp-form');

        newMdpBtn.addEventListener('click', function() {
            newMdpForm.classList.toggle('d-none'); 
            newMdpForm.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../inc/js/moderation_user.js"></script>
</body>
</html>