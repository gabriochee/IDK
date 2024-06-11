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
<body id="backoffice_edit_terms_and_conditions" class="backoffice">
    <?php require_once('../inc/php/db.php'); ?>
    <?php require_once('../inc/backoffice/header.php');?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/backoffice/sidebar.php');?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="container border border-black rounded-2 border-2 mt-3">
                    <h1 class="text-center mt-4">Page : Conditions Générales</h1>
                    <p class="text-end">Date de modifications : 01/01/2024 00:00</p>
                    <hr class="featurette-divider my-2">
                    
                    <div class="container col-9 mb-5">
                        <h3>Conditions Générales d'Utilisation</h3>
                        <p>Bienvenue sur IDK ! Veuillez lire attentivement les présentes conditions générales d'utilisation (ci-après dénommées les "CGU") avant d'utiliser notre plateforme.</p>
                        <br/>

                        <h3>Acceptation des Conditions Générales</h3>
                        <p>En accédant ou en utilisant notre plateforme, vous acceptez d'être lié par les présentes CGU. Si vous n'acceptez pas ces termes, veuillez ne pas accéder à notre site ou l'utiliser.</p>
                        <br/>

                        <h3>Utilisation de notre platefrome</h3>
                        <p>Vous devez avoir au moins 18 ans pour utiliser notre plateforme. En utilisant notre site, vous déclarez et garantissez que vous avez l'âge légal pour conclure un contrat contraignant avec nous et que vous acceptez de vous conformer à ces CGU.</p>
                        <br/>
                        
                        <h3>Compte Utilisateur</h3>
                        <p>Pour accéder à certaines fonctionnalités de notre plateforme, vous devrez peut-être créer un compte utilisateur. Vous êtes responsable de maintenir la confidentialité de votre compte et de votre mot de passe, et vous acceptez de ne pas partager ces informations avec des tiers.</p>
                        <br/>

                        <h3>Contenu Utilisateur</h3>
                        <p>En utilisant notre plateforme, vous acceptez de respecter les lois applicables et de ne pas publier de contenu qui soit diffamatoire, offensant, illégal ou qui viole les droits de propriété intellectuelle de tiers.</p>
                        <br/>

                        <h3>Propriété Intellectuelle</h3>
                        <p>Tout le contenu présent sur notre plateforme, y compris les textes, les graphiques, les logos, les icônes et les images, est la propriété exclusive de idk ou de ses concédants de licence et est protégé par les lois sur la propriété intellectuelle.</p>
                        <br/>

                        <h3>Limitation de Responsabilités</h3>
                        <p>Nous nous efforçons de maintenir notre plateforme accessible et fonctionnelle, mais nous ne garantissons pas son fonctionnement ininterrompu ou exempt d'erreurs. En aucun cas, idk ne pourra être tenu responsable des dommages directs, indirects, spéciaux, accessoires ou consécutifs découlant de l'utilisation de notre site.</p>
                        <br/>

                        <h3>Modification des CGU</h3>
                        <p>Nous nous réservons le droit de modifier à tout moment les présentes CGU. Les modifications prendront effet dès leur publication sur notre site. En continuant à utiliser notre plateforme après la publication des modifications, vous acceptez d'être lié par les CGU révisées.</p>
                        <br/>

                        <h3>Loi Applicable</h3>
                        <p>Les présentes CGU sont régies par les lois en vigueur en france et tout litige découlant de ces termes et conditions sera soumis à la compétence exclusive des tribunaux de paris.</p>
                        <br/>

                        <h3>Traitement des Données Personnelles</h3>
                        <p>Nous attachons une grande importance à la protection de vos données personnelles. En utilisant notre plateforme, vous consentez à la collecte, au traitement et à l'utilisation de vos données personnelles telles que décrites dans notre politique de confidentialité.<br/>Nous collectons et utilisons vos données personnelles dans le but de vous fournir nos services, de personnaliser votre expérience utilisateur, de communiquer avec vous et de vous informer des mises à jour et des nouveautés de notre plateforme. Nous ne vendrons pas, ne louerons pas et ne partagerons pas vos données personnelles avec des tiers à des fins de marketing sans votre consentement explicite.</p>
                        <br/>

                        <h3>Traitement des Cookies</h3>
                        <p>Nous utilisons des cookies et d'autres technologies de suivi pour améliorer votre expérience utilisateur sur notre site web. Les cookies sont de petits fichiers texte placés sur votre appareil lorsque vous visitez notre site web. Ils nous aident à analyser l'utilisation de notre site web, à personnaliser le contenu et les publicités, et à vous fournir des fonctionnalités de médias sociaux.<br/>En utilisant notre site web, vous consentez à l'utilisation de cookies conformément à notre politique de cookies. Vous pouvez contrôler l'utilisation des cookies en modifiant les paramètres de votre navigateur web, mais veuillez noter que certaines fonctionnalités de notre site web peuvent ne pas fonctionner correctement si les cookies sont désactivés.</p>
                        <br/>

                        <h3>Politique de Confidentialité et de Cookies</h3>
                        <p>Pour plus d'informations sur la manière dont nous collectons, utilisons et protégeons vos données personnelles, veuillez consulter notre politique de confidentialité et notre politique de cookies.</p>
                        <br/>

                        <h3>Contact</h3>
                        <p>Si vous avez des questions ou des préoccupations concernant le traitement de vos données personnelles ou l'utilisation des cookies, veuillez nous contacter à l'adresse suivante : [adresse e-mail de contact].</p>
                        <br/>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-75 my-3" id="modifier-terms">Modifier</button>
                </div>

                <form method="post" id="form-terms">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="titre-bloc1" class="form-label">Titre du bloc 1</label>
                            <textarea class="form-control" id="titre-bloc1" name="titre-bloc1" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc1" class="form-label">Texte du bloc 1</label>
                            <textarea class="form-control" id="texte-bloc1" name="texte-bloc1"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc2" class="form-label">Titre du bloc 2</label>
                            <textarea class="form-control" id="titre-bloc2" name="titre-bloc2" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc2" class="form-label">Texte du bloc 2</label>
                            <textarea class="form-control" id="texte-bloc2" name="texte-bloc2"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc3" class="form-label">Titre du bloc 3</label>
                            <textarea class="form-control" id="titre-bloc3" name="titre-bloc3" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc3" class="form-label">Texte du bloc 3</label>
                            <textarea class="form-control" id="texte-bloc3" name="texte-bloc3"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc4" class="form-label">Titre du bloc 4</label>
                            <textarea class="form-control" id="titre-bloc4" name="titre-bloc4" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc4" class="form-label">Texte du bloc 4</label>
                            <textarea class="form-control" id="texte-bloc4" name="texte-bloc4"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc5" class="form-label">Titre du bloc 5</label>
                            <textarea class="form-control" id="titre-bloc5" name="titre-bloc5" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc5" class="form-label">Texte du bloc 5</label>
                            <textarea class="form-control" id="texte-bloc5" name="texte-bloc5"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc6" class="form-label">Titre du bloc 6</label>
                            <textarea class="form-control" id="titre-bloc6" name="titre-bloc6" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc6" class="form-label">Texte du bloc 6</label>
                            <textarea class="form-control" id="texte-bloc6" name="texte-bloc6"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc7" class="form-label">Titre du bloc 7</label>
                            <textarea class="form-control" id="titre-bloc7" name="titre-bloc7" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc7" class="form-label">Texte du bloc 7</label>
                            <textarea class="form-control" id="texte-bloc7" name="texte-bloc7"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc8" class="form-label">Titre du bloc 8</label>
                            <textarea class="form-control" id="titre-bloc8" name="titre-bloc8" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc8" class="form-label">Texte du bloc 8</label>
                            <textarea class="form-control" id="texte-bloc8" name="texte-bloc8"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc9" class="form-label">Titre du bloc 9</label>
                            <textarea class="form-control" id="titre-bloc9" name="titre-bloc9" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc9" class="form-label">Texte du bloc 9</label>
                            <textarea class="form-control" id="texte-bloc9" name="texte-bloc9"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc10" class="form-label">Titre du bloc 10</label>
                            <textarea class="form-control" id="titre-bloc10" name="titre-bloc10" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc10" class="form-label">Texte du bloc 10</label>
                            <textarea class="form-control" id="texte-bloc10" name="texte-bloc10"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc11" class="form-label">Titre du bloc 11</label>
                            <textarea class="form-control" id="titre-bloc11" name="titre-bloc11" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc11" class="form-label">Texte du bloc 11</label>
                            <textarea class="form-control" id="texte-bloc11" name="texte-bloc11"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc12" class="form-label">Titre du bloc 12</label>
                            <textarea class="form-control" id="titre-bloc12" name="titre-bloc12" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc12" class="form-label">Texte du bloc 12</label>
                            <textarea class="form-control" id="texte-bloc12" name="texte-bloc12"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc13" class="form-label">Titre du bloc 13</label>
                            <textarea class="form-control" id="titre-bloc13" name="titre-bloc13" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc13" class="form-label">Texte du bloc 13</label>
                            <textarea class="form-control" id="texte-bloc13" name="texte-bloc13"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="titre-bloc14" class="form-label">Titre du bloc 14</label>
                            <textarea class="form-control" id="titre-bloc14" name="titre-bloc14" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="texte-bloc14" class="form-label">Texte du bloc 14</label>
                            <textarea class="form-control" id="texte-bloc14" name="texte-bloc14"></textarea>
                        </div>
                        <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 my-3" type="submit" value="">Enregistrement</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script src="../inc/js/edit_terms.js"></script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>