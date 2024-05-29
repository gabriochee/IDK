<?php
    session_start();
    require('../../inc/php/function_search_user.php');
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
<body id="connected_my_friend_list">
    <?php require('../../inc/connected/header.php'); ?>
    <h1 class ="text-center my-5">Mes amis:</h1>
    <div class="container text-center m-auto">
        <div class="row">
            <div class="d-flex justify-content-around">
                <?php 
                    foreach($rep4 as $rep4){
                        echo '<div class="card-body bg-primary m-5">';
                        echo '    <div class="card-text"><span>' . htmlspecialchars($rep4['pseudo']). '<br>' . htmlspecialchars($rep4['nom']).'<br>'.htmlspecialchars($rep4['prenom']).'</span></div>';
                        //if($i_sended_req = )
                        echo '    <a href="my_friend_req.php?demande=supp_friend&id='.$rep4['id_user'].'" class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto text-center" type="submit" name="envoyer_ami">supprimer ami</a>';
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