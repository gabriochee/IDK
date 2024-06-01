<?php
    session_start();
    require('../../inc/php/function_search_user.php');
    require_once('../../inc/php/log.php');

    $root_path = __FILE__;
    $parent_path = dirname(dirname($root_path));
    $relative_path = str_replace($parent_path, '', $root_path);

    server_log("Consultation de la page " . $relative_path);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/style/style.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="connected_my_requested_friend">
    <?php require('../../inc/connected/header.php'); ?>
    <h1 class ="text-center my-5">Les demandes d'amis que j'ai faites:</h1>
    <div class="container text-center m-auto">
        <div class="row">
            <div class="d-flex justify-content-around">
                <?php 
                    //$i_sended_req =mes_envoies($_SESSION['id_user'], $_GET['id'], $bdd);
                    foreach($rep3 as $rep3){
                            echo '<div class="card-body bg-primary m-5">';
                            echo '    <div class="card-text"><span>' . htmlspecialchars($rep3['pseudo']). '<br>' . htmlspecialchars($rep3['nom']).'<br>'.htmlspecialchars($rep3['prenom']).'</span></div>';
                            echo '    <a href="my_requested_friend.php?demande=cancel_req&id='.$rep3['id_user'].'" class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto text-center" type="submit" name="envoyer_ami">Annuler_demande</a>';
                            echo '</div>';
                        }  
                ?>
            </div>
        </div>
    </div>
    <?php require('../../inc/connected/footer.php'); ?>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>