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

<body id="not_connected_login">
    <?php require_once('../../inc/php/function_login.php'); ?>
    <header class="container w-100 d-flex justify-content-end mt-5 h-100">
        <button  id="dark-mode" class="nav-link btn">
            <i class="bi bi-moon-stars fs-3 mx-3" height="100" width="100"></i>
        </button>
        <button class="nav-link btn" onclick="window.location='home.php'">
            <i class="bi bi-arrow-return-left fs-3" height="100" width="100"></i>
        </button>
    </header>
    <main>
        <div class="container col-sm-6 col-xl-4">
            <div class="row g-3">
                <div class="d-flex m-auto col-lg-6 p-3 justify-content-center mb-3">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid" width="150px" height="150px">
                </div>
                <form action="login.php" class="needs-validation" method="POST">
                    <div class="col-12">
                        <input type="text" class="form-control p-2" id="username" placeholder="Addresse email/pseudo" name="email" value="" required="">
                        <div class="invalid-feedback">Veuillez fournir un pseudo ou email valide.</div>
                    </div>
                    <div class="col-12 mt-1">
                        <input type="password" class="form-control p-2" name="password" id="password" placeholder="Mot de passe" value="" required="">
                        <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                    </div>
                    <div class="text-center fs-4">
                    <?php
                        if (isset($_GET['wrong_email'])) {echo "<div class='alert alert-danger' role='alert'>L'email ou le mot de passe ou les deux sont erronés</div>";}
                        if (isset($_GET['wrong_mdp'])) {echo "<div class='alert alert-danger' role='alert'>L'email ou le mot de passe ou les deux sont erronés</div>";}
                        if (isset($_GET['supprime'])) {echo "<div class='alert alert-danger' role='alert'>Ton compte a été supprimé</div>";}
                        if (isset($_GET['ban_def'])) { echo "<div class='alert alert-danger' role='alert'>Vous êtes banni définitivement Raison : " . htmlspecialchars(urldecode($_GET['raison'])) . "</div>"; }
                        if (isset($_GET['ban_not_def'])) {echo "<div class='alert alert-danger' role='alert'>Vous êtes banni temporairement. Raison : " . htmlspecialchars(urldecode($_GET['raison'])) . ". Date de débannissement : " . htmlspecialchars(urldecode($_GET['date_deban'])) . "</div>";
                        }
                        if (isset($_GET['wrong_captcha'])) {
                            echo "<div class='alert alert-danger' role='alert'>Le captcha est invalide.</div>";
                        }
                        ?>
                    </div>
                    <div class="alert alert-primary mt-3 text-center" role="alert">Répondez à cette question afin de prouver que vous n'êtes pas un robot.</div>
                    <hr>
                    <div class="container text-center">
                        <h3>
                            <?php
                            $request = $bdd->query('SELECT id_captcha FROM captcha;');
                            $result = $request->fetchAll();
                            $random_id = $result[rand(0, count($result) - 1)]['id_captcha'];

                            $request = $bdd->query('SELECT question FROM captcha WHERE id_captcha = ' . $random_id . ';');
                            $result = $request->fetch();

                            echo $result['question'];
                            ?>
                        </h3>
                    </div>

                    <div class="container-fluid d-flex justify-content-center gap-2 p-0 mb-4">
                        <?php
                        $request = $bdd->query('SELECT reponse_captcha.contenu, reponse_captcha.id_reponse FROM reponse_captcha JOIN correspondance_captcha ON correspondance_captcha.id_reponse = reponse_captcha.id_reponse WHERE correspondance_captcha.id_captcha = ' . $random_id . ';');

                        $result = $request->fetchAll();
                        $i = 0;

                        foreach ($result as $key => $value) {
                            echo '<input type="radio" class="btn-check" name="captcha_answer" value="' . $value['id_reponse'] . '" id="option' . $i . '" autocomplete="off">';
                            echo '<label class="w-100 nav-btn btn btn-sm btn-info border border-dark fs-sm-5 px-3" for="option' . $i . '">' . $value['contenu'] . '</label>';
                            $i++;
                        }
                        ?>
                        <input type="hidden" id="captcha_id" name="captcha_id" value="<?php echo $random_id; ?>">
                    </div>
                    <div class="col-12 mt-3">
                        <button class="w-100 btn btn-warning border-dark " type="submit" name="connecter">Connexion</button>
                    </div>
                </form>
                <div class="col-12">
                    <button class="w-100 btn btn-warning border-dark " type="submit" onclick="window.location='signin.php'">S'inscrire</button>
                </div>
                <div class="col-12 mt-1">
                    <button class="w-100 btn btn-warning border-dark " type="submit">Mot de passe oublié</button>
                </div>
            </div>
        </div>

    </main>
    <script>

        document.addEventListener('DOMContentLoaded', (event) => {
            const toggleButton = document.getElementById('dark-mode');

            const enableDarkMode = () => {
                document.body.classList.add('dark-mode');
                localStorage.setItem('dark-mode', 'enabled');
            };

            const disableDarkMode = () => {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('dark-mode', 'disabled');
            };

            if (localStorage.getItem('dark-mode') === 'enabled') {
                enableDarkMode();
            } else if (localStorage.getItem('dark-mode') === 'disabled') {
                disableDarkMode();
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                enableDarkMode();
            }

            toggleButton.addEventListener('click', () => {
                if (document.body.classList.contains('dark-mode')) {
                    disableDarkMode();
                } else {
                    enableDarkMode();
                }
            });
        });

    </script>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>