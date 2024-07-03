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
<body id="connected_parameters">
    <?php require_once('../../inc/php/parameter_user_update.php'); ?>
    <?php require_once('../../inc/components/connected/header.php'); ?>
    <?php require_once('../../inc/php/affichage_data_user.php'); ?>
    <?php require_once('../../inc/library/fpdf/function_fpdf_co.php'); ?>
    <?php require_once('../../inc/php/upload_image.php');?>
    
    <main>
        <div class="container-fluid mt-5 mb-5 py-2">
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

                    <form action="parameters.php" method="POST">
                        <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mt-1" id="signin-btn" type="submit" name="export">Exporter mes données</button>
                    </form>

                    <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mt-1" id="new-mdp-btn" type="button">Changer mon mot de passe</button>
                    
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

                    <form action="parameters.php" method="POST">
                        <button class="w-100 btn btn-warning border-dark d-flex m-auto justify-content-center mt-1" id="desinscription-btn" type="submit" name="unsubscription">Se désinscrire</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php require_once('../../inc/components/connected/footer.php'); ?>
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
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>