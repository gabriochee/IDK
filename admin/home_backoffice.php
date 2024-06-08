<?php 
session_start();

if(!(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin')) {
    header("Location: ../client/not_connected/login.php");
    exit();
}
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
<body id="backoffice_home_backoffice" class="backoffice">
    <?php require('../inc/php/db.php'); ?>
    <?php require('../inc/backoffice/header.php');?>
    <div class="container-fluid">
        <div class="row">
            <?php require('../inc/backoffice/sidebar.php');?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-4 border-bottom">
                    <h3>Administrateurs : </h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            Léo Belarbi #1 depuis 01/01/2024
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            Gabriel Plaaaaaa #2 depuis 01/01/2024
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            Eric Sang #3 depuis 01/01/2024
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                            </div>
                        </li>
                    </ul>
                    <div id="newAdmin" class="d-none">
                        <div class="container text-center m-auto">
                            <div class="text-center pt-5 fs-2">
                            <?php 
                                if(isset($_GET['wrong_email'])) {echo "cet email a déja été utilisé ";} 
                                if(isset($_GET['error_message'])) {echo '<script>alert("' . htmlspecialchars($_GET['error_message']) . '");</script>';}
                            ?>
                            </div>
                        </div>
                        <div class="contact-form row g-5 justify-content-center mb-4">
                            <div class="col-md-7 col-lg-8">
                                <form action="./confirmation_inscription.php" class="needs-validation" id="signin-form" method="POST">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-ZÀ-ÿ0-9.' -]{2,40}" required value="<?php if (isset($_POST['firstName'])) {echo $_POST['firstName'];} ?>">
                                            <div class="invalid-feedback">Veuillez fournir un prénom valide.</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="lastName" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-ZÀ-ÿ0-9.' -]{2,40}" required value="<?php if (isset($_POST['lastName'])) {echo $_POST['lastName'];} ?>">
                                            <div class="invalid-feedback">Veuillez fournir un nom valide.</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="username" class="form-label">Pseudo</label>
                                            <input type="text" class="form-control" id="username" name="username" pattern="{,100}" required value="<?php if (isset($_POST['username'])) {echo $_POST['username'];} ?>">
                                            <div class="invalid-feedback">Veuillez fournir un pseudo existant valide.</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="sexe" class="form-label">Sexe</label>
                                            <select class="form-select" id="sexe" name="sexe" required value="<?php if (isset($_POST['sexe'])) {echo $_POST['sexe'];} ?>">
                                                <option value="homme">Homme</option>
                                                <option value="femme">Femme</option>
                                                <option value="autre">Autre</option>
                                            </select>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <div class="col-3">
                                                <label for="birthday-day" class="form-label">Jour</label>
                                                <input type="number" class="form-control" id="birthday-day" name="birthday-day" min="1" max="31" value="<?php if (isset($_POST['birthday-day'])) {echo $_POST['birthday-day'];} ?>">
                                                <div class="invalid-feedback">Veuillez fournir un jour valide.</div>
                                            </div>
                                            <div class="col-4">
                                                <label for="birthday-month" class="form-label">Mois</label>
                                                <select class="form-control" name="birthday-month" id="birdthday-month">
                                                    <option disabled <?php if (!isset($_POST['birthday-month'])){ echo 'selected';} ?> value></option>
                                                    <option value="01" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "01"){ echo 'selected';} ?>>janvier</option>
                                                    <option value="02" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "02"){ echo 'selected';} ?>>février</option>
                                                    <option value="03" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "03"){ echo 'selected';} ?>>mars</option>
                                                    <option value="04" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "04"){ echo 'selected';} ?>>avril</option>
                                                    <option value="05" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "05"){ echo 'selected';} ?>>mai</option>
                                                    <option value="06" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "06"){ echo 'selected';} ?>>juin</option>
                                                    <option value="07" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "07"){ echo 'selected';} ?>>juillet</option>
                                                    <option value="08" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "08"){ echo 'selected';} ?>>août</option>
                                                    <option value="09" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "09"){ echo 'selected';} ?>>septembre</option>
                                                    <option value="10" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "10"){ echo 'selected';} ?>>octobre</option>
                                                    <option value="11" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "11"){ echo 'selected';} ?>>novembre</option>
                                                    <option value="12" <?php if (isset($_POST['birthday-month']) && $_POST['birthday-month'] == "12"){ echo 'selected';} ?>>décembre</option>
                                                </select>
                                                <div class="invalid-feedback">Veuillez fournir un mois valide.</div>
                                            </div>

                                            <div class="col-3">
                                                <label for="birthday-year" class="form-label">Année</label>
                                                <input type="number" class="form-control" name="birthday-year" id="birdthday-year" min="1900" max="<?php echo (date("Y")); ?>" value="<?php if (isset($_POST['birthday-year'])) {echo $_POST['birthday-year'];} ?>">
                                                <div class="invalid-feedback">Veuillez fournir une année valide.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" pattern="{,100}" required value="<?php if (isset($_POST['email'])) {echo $_POST['email'];} ?>">
                                            <div class="invalid-feedback">Veuillez fournir un email valide.</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="phone" class="form-label">Numéro de téléphone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" pattern="{,100}" required value="<?php if (isset($_POST['phone'])) {echo $_POST['phone'];} ?>">
                                            <div class="invalid-feedback">Veuillez fournir un numéro de téléphone valide.</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Mot de passe</label><br/>
                                            <label for="password" class="form-label m-0"><i><small>8 et 16 caractères, au moins une majuscules, une minuscules, un chiffres et un caractères spécial.</small></i></label>                                            <input type="password" class="form-control" id="password" name="password" maxlength="100" required>
                                            <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="password-confirmation" class="form-label">Mot de passe confirmation</label>
                                            <input type="password" class="form-control" id="password-confirmation" name="password-confirmation" maxlength="100" required>
                                            <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="sexe" class="form-label">Newsletter</label>
                                            <select class="form-select" name="newsletter" required>
                                                <option value="1" <?php if (isset($_POST['newsletter']) && $_POST['newsletter'] == "1"){ echo 'selected';} ?>>J'accepte de reçevoir la Newsletter</option>
                                                <option value="0" <?php if (isset($_POST['newsletter']) && $_POST['newsletter'] == "0"){ echo 'selected';} ?>>Je refuse de recevoir la Newsletter</option>
                                            </select>
                                        </div> <!-- add role = admin ou user -->
                                        <button class="w-100 btn btn-secondary btn-lg btn-warning border-dark border-2" id="signin-btn" type="submit" name="send">S'inscrire</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-75 my-3" id="new_user">Ajouter un administrateur</button>
                    </div>
                </div>

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
                                <h4 class="my-0 fw-normal">Nombres d'oeuvre stockée dans la base <small>(le 12/12/2024 12:12:12)</small></h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">8 000 000</small></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal">Moyennes d'ages des utilisateurs</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">34 ans</small></h1>
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
                    <div class="col d-flex align-items-center"><canvas id="proportion_sexe"></canvas></div>
                    <div class="col-md-6 mt-3"><canvas id="nb_inscription"></canvas></div>
                    <div class="col-md-6 mt-3"><canvas id="creation_listes"></canvas></div>
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
                        <!-- mettre tableau des pages les plus visiter filtrable (jour:defaut, semaine, mois, année, all) -->
                    </div>
                </div>
            </main>

        </div>
    </div>
    <script>
        const newAdmin = document.getElementById("newAdmin");
        document.getElementById("new_user").addEventListener("click", function() {
            newAdmin.classList.replace("d-none", "d-block");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../inc/js/home_backoffice.js"></script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
