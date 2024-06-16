<?php require_once('../inc/php/access.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/style/style.css">
    <link rel="stylesheet" href="../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>Conditions Générales - IDK</title>
</head>
<body id="backoffice_edit_terms_and_conditions" class="backoffice">
    <?php require_once('../inc/php/db.php'); ?>
    <?php require_once('../inc/components/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/components/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container border border-black rounded-2 border-2 mt-3">
                    <h1 class="text-center mt-4">Page : Conditions Générales</h1>
                    <p class="text-end">Date de modifications : 01/01/2024 00:00</p>
                    <hr class="featurette-divider my-2">
                    
                    <div class="container col-9 mb-5">
                        <h3>Conditions Générales d'Utilisation</h3>
                        <p>Bienvenue sur IDK ! Veuillez lire attentivement les présentes conditions générales d'utilisation (ci-après dénommées les "CGU") avant d'utiliser notre plateforme.</p>
                        <h3>Acceptation des Conditions Générales</h3>
                        <p>En accédant ou en utilisant notre plateforme, vous acceptez d'être lié par les présentes CGU. Si vous n'acceptez pas ces termes, veuillez ne pas accéder à notre site ou l'utiliser.</p>
                        <h3>Utilisation de notre plateforme</h3>
                        <p>Vous devez avoir au moins 18 ans pour utiliser notre plateforme. En utilisant notre site, vous déclarez et garantissez que vous avez l'âge légal pour conclure un contrat contraignant avec nous et que vous acceptez de vous conformer à ces CGU.</p>
                        <h3>Compte Utilisateur</h3>
                        <p>Pour accéder à certaines fonctionnalités de notre plateforme, vous devrez peut-être créer un compte utilisateur. Vous êtes responsable de maintenir la confidentialité de votre compte et de votre mot de passe, et vous acceptez de ne pas partager ces informations avec des tiers.</p>
                        <h3>Contenu Utilisateur</h3>
                        <p>En utilisant notre plateforme, vous acceptez de respecter les lois applicables et de ne pas publier de contenu qui soit diffamatoire, offensant, illégal ou qui viole les droits de propriété intellectuelle de tiers.</p>
                        <h3>Propriété Intellectuelle</h3>
                        <p>Tout le contenu présent sur notre plateforme, y compris les textes, les graphiques, les logos, les icônes et les images, est la propriété exclusive de IDK ou de ses concédants de licence et est protégé par les lois sur la propriété intellectuelle.</p>
                        <h3>Limitation de Responsabilités</h3>
                        <p>Nous nous efforçons de maintenir notre plateforme accessible et fonctionnelle, mais nous ne garantissons pas son fonctionnement ininterrompu ou exempt d'erreurs. En aucun cas, IDK ne pourra être tenu responsable des dommages directs, indirects, spéciaux, accessoires ou consécutifs découlant de l'utilisation de notre site.</p>
                        <h3>Modification des CGU</h3>
                        <p>Nous nous réservons le droit de modifier à tout moment les présentes CGU. Les modifications prendront effet dès leur publication sur notre site. En continuant à utiliser notre plateforme après la publication des modifications, vous acceptez d'être lié par les CGU révisées.</p>
                        <h3>Loi Applicable</h3>
                        <p>Les présentes CGU sont régies par les lois en vigueur en France et tout litige découlant de ces termes et conditions sera soumis à la compétence exclusive des tribunaux de Paris.</p>
                        <h3>Traitement des Données Personnelles</h3>
                        <p>Nous attachons une grande importance à la protection de vos données personnelles. En utilisant notre plateforme, vous consentez à la collecte, au traitement et à l'utilisation de vos données personnelles telles que décrites dans notre politique de confidentialité. Nous collectons et utilisons vos données personnelles dans le but de vous fournir nos services, de personnaliser votre expérience utilisateur, de communiquer avec vous et de vous informer des mises à jour et des nouveautés de notre plateforme. Nous ne vendrons pas, ne louerons pas et ne partagerons pas vos données personnelles avec des tiers à des fins de marketing sans votre consentement explicite.</p>
                        <h3>Traitement des Cookies</h3>
                        <p>Nous utilisons des cookies et d'autres technologies de suivi pour améliorer votre expérience utilisateur sur notre site web. Les cookies sont de petits fichiers texte placés sur votre appareil lorsque vous visitez notre site web. Ils nous aident à analyser l'utilisation de notre site web, à personnaliser le contenu et les publicités, et à vous fournir des fonctionnalités de médias sociaux. En utilisant notre site web, vous consentez à l'utilisation de cookies conformément à notre politique de cookies. Vous pouvez contrôler l'utilisation des cookies en modifiant les paramètres de votre navigateur web, mais veuillez noter que certaines fonctionnalités de notre site web peuvent ne pas fonctionner correctement si les cookies sont désactivés.</p>
                        <h3>Politique de Confidentialité et de Cookies</h3>
                        <p>Pour plus d'informations sur la manière dont nous collectons, utilisons et protégeons vos données personnelles, veuillez consulter notre politique de confidentialité et notre politique de cookies.</p>
                        <h3>Contact</h3>
                        <p>Si vous avez des questions ou des préoccupations concernant le traitement de vos données personnelles ou l'utilisation des cookies, veuillez nous contacter à l'adresse suivante : [adresse e-mail de contact].</p>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-75 my-3" id="modifier-terms">Modifier</button>
                </div>

                <form method="post" id="form-terms">
                    <div class="row g-3">
                        <?php
                        for ($i = 1; $i <= 14; $i++) {
                            echo '<div class="col-12">';
                            echo '<label for="titre-bloc'.$i.'" class="form-label">Titre du bloc '.$i.'</label>';
                            echo '<textarea class="form-control" id="titre-bloc'.$i.'" name="titre-bloc'.$i.'" required></textarea>';
                            echo '</div>';
                            echo '<div class="col-12">';
                            echo '<label for="texte-bloc'.$i.'" class="form-label">Texte du bloc '.$i.'</label>';
                            echo '<textarea class="form-control" id="texte-bloc'.$i.'" name="texte-bloc'.$i.'"></textarea>';
                            echo '</div>';
                        }
                        ?>
                        <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 my-3" type="submit">Enregistrement</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script src="../inc/js/edit_terms.js"></script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
