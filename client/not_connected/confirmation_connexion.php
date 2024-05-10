<?php
    session_start();
    require_once('../../inc/php/db.php');
    
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
        
        $req = $bdd->prepare("UPDATE UTILISATEUR SET code_verification = :verification_code WHERE mail = :email;");
        $req->execute(
            array(
                "email" => $email,
                "verification_code" => $verification_code
            )
        );
        try {
            $mail->send();
            
            header('Location: confirmation_connexion.php?email_sent=true');
            exit; 
            
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            echo "Code erreur : " . $e->getCode();
            echo "Erreur lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
        }
            
       
    }

    if (isset($_POST['connect'])) {
    
        $connect = $_POST['entrer_code'];
        if($connect != ""){
            $email = $_SESSION['email'];
            $req = $bdd->prepare("SELECT mail, code_verification FROM UTILISATEUR WHERE mail = :email;");
            $req->execute(
                array(
                    "email" => $email
                )
            );
            $reponse = $req->fetch();
            if ($reponse) {
                $code_verification = $reponse['code_verification'];
                if ($connect == $code_verification) {
                    header('Location: ../connected/home.php');
                } else {
                    header('Location: confirmation_connexion.php?wrong_code=true');
                }
            }
        }
    }

?>



<!DOCTYPE html>
<html lang="fr">
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
    <header class="container w-100 d-flex justify-content-end mt-5">
        <button class="nav-link btn">
            <i class="bi bi-moon-stars fs-3" height="100" width="100"></i>
        </button>
    </header>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                </div>
            </div>
        </div>

        <div class="container col-sm-6 col-xl-4">


            <form action="confirmation_connexion.php" class="needs-validation" method="POST">
                <div class="container px-sm-4 col-sm-10">
                    <label for="entrer_code">Veuillez entrer votre code envoyé par mail</label>
                    <input type="text" class="form-control fs-4 minimize-input border-dark border-2 rounded-0 rounded-top text-center py-3" id="username" placeholder="" name ="entrer_code" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir le code de vérification envoyé par mail.</div>
                </div>

                <div class="text-center">
                    <?php 
                    //vérifies si wrong_code existe et si elle est = a true
                        if (isset($_GET['wrong_code'])&& $_GET['wrong_code'] === 'true'){
                            echo "Le code est faux";
                        }
                        
                        if (isset($_GET['email_sent']) && $_GET['email_sent'] === 'true') {
                            echo 'le mail de vérification a été envoyé';
                        }
                    ?>
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
</body>
</html>