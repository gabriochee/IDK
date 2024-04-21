<?php
    session_start();
    require_once('db.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../not_connected/PHPMailer/src/Exception.php';
    require '../not_connected/PHPMailer/src/PHPMailer.php';
    require '../not_connected/PHPMailer/src/SMTP.php';
    $email = $_SESSION['email'];
    if (isset($_POST['code'])) {
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'annuelprojet2@gmail.com';
        $mail->Password = 'zwcsygpubwzvaysr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        
        $mail->setFrom('annuelprojet2@gmail.com');
        $email = $_SESSION['email'];
        $mail->addAddress($email);
        $mail->isHTML(true);

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $mail->Subject = 'Email verification';
        $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
        
        $result = $bdd->query("UPDATE UTILISATEUR SET code_verification = '$verification_code' WHERE mail = '$email';");

        
        try {
            $mail->send();
            
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            echo '<br>';
            echo "Code erreur : " . $e->getCode();
            echo 'salut';
            echo "Erreur lors de l'envoi de l'e-mail : " . $e->getMessage(); // Affiche le message d'erreur générique de PHPMailer
            // Gestion des erreurs d'envoi d'e-mail
            echo "Erreur lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
        }
        
    }
    if (isset($_POST['connect'])) {
    
        $connect = $_POST['entrer_code'];
        if($connect != ""){
            $email = $_SESSION['email'];
            $req = $bdd->query("SELECT * FROM UTILISATEUR WHERE mail = '$email';");
            $reponse = $req->fetch();
            
            var_dump($reponse);
            if ($reponse) {
                $code_verification = $reponse['code_verification'];
                if ($connect == $code_verification) {
                    echo "Code correct. L'utilisateur est authentifié.";
                } else {
                    echo "Code incorrect. Veuillez réessayer.";
                }
            }
        }
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/functions.php">
    <link rel="stylesheet" href="../../inc/style.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>

<body>
    <header class="container w-100 d-flex justify-content-end mt-5 h-100">
        <button class="nav-link btn">
            <i class="bi bi-moon-stars fs-3" height="100" width="100"></i>
        </button>
    </header>
    <main>
        <div class="container-fluid d-flex justify-content-center my-5 py-2">
            <img src="../../inc/logo.svg" alt="Logo IDK" class="img-thumbnail bg-transparent border-0">
        </div>

        <div class="container col-sm-6 col-xl-4">


            <form action="./home.php" class="needs-validation" method="POST">
                <div class="container px-sm-4 col-sm-10">
                    <label for="entrer_code">Veuillez entrer votre code envoyé par mail</label>
                    <input type="text" class="form-control fs-4 minimize-input border-dark border-2 rounded-0 rounded-top text-center py-3" id="username" placeholder="" name ="entrer_code" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir le code de vérification envoyé par mail.</div>
                </div>
                <div class="container px-sm-4 col-sm-10 mt-4">
                    <button class="btn btn-lg w-100 py-2 fs-4 btn-warning border-dark border-2" type="submit" name ="connect">
                        Connexion
                    </button>
                </div>
            </form>


            <form action="confirmation_connexion.php" method="POST">
                <div class="container px-sm-4 col-sm-10 mt-4">
                    <button class="btn btn-lg w-100 py-2 fs-4 btn-warning border-dark border-2" type="buton" name ="code">
                        envoyer le code par mail
                    </button>
                </div>
            </form>
                
        </div>
    </main>

<script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../inc/script.js"></script>
</body>
</html>