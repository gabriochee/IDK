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
<body id="connected_show_user">
    <?php require('../../inc/connected/header.php'); ?>
    <h1 class ="text-center my-5">All user connected</h1>
    <div class="container text-center m-auto">
        <div class="row">
            <div class="d-flex justify-content-around">*
            
            <?php /*foreach($rep1 as $rep1):?>
                <?php if($rep1['id_user'] !== $_SESSION['id_user']):?>
                    <div class="card-body bg-primary m-5">
                        <p class="card-text">pseudo: <?= $rep1['pseudo']?> <br>nom: <?= $rep1['nom']?> <br>prenom: <?= $rep1['prenom']?></p>
                        <a href="show_user.php?id=''" class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto text-center">Unfriend</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; */?>
            <?php
                foreach ($rep1 as $user) {
                    if ($user['id_user'] !== $_SESSION['id_user']) {
                        echo '<div class="card-body bg-primary m-5">';
                        echo '    <div class="card-text"><span>' . htmlspecialchars($user['pseudo']). '<br>' . htmlspecialchars($user['nom']).'<br>'.htmlspecialchars($user['prenom']).'</span></div>';
                    $test=is_friend_already($_SESSION['id_user'], $user['id_user'], $bdd);
                    
                    // Vérifier si une demande d'ami a déjà été envoyée
                    if  ($test){
                        echo '<button class="btn btn-secondary" disabled>already friend</button>';
                    }else if (check_friend_request_status($_SESSION['id_user'], $user['id_user'], $bdd)){
                        echo '<button class="btn btn-secondary" disabled>request sent</button>';
                    }
                    else {
                        echo '<a href="show_user.php?demande=attente_demande_ami&id=' . $user['id_user'] . '" class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto text-center" type="submit" name="envoyer_ami">Be Friend</a>';
                    }
                    
                    echo '</div>';
                    }
                    
                }    
            ?>

        </div>
    </div>
</div>




    <?php require('../../inc/connected/footer.php'); ?>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>