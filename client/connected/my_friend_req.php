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
<body>
    
    <?php require('../../inc/connected/header.php'); ?>
    <h1 class ="text-center my-5">Ceux qui m'ont demandé ami:</h1>
    <div class="container text-center m-auto">
    <div class="row">
        <div class="d-flex justify-content-around">
            <?php 
                foreach($rep2 as $rep2){
                        echo '<div class="card-body bg-primary m-5">';
                        echo '    <div class="card-text"><span>' . htmlspecialchars($rep2['pseudo']). '<br>' . htmlspecialchars($rep2['nom']).'<br>'.htmlspecialchars($rep2['prenom']).'</span></div>';
                        //if($i_sended_req = )
                        echo '    <a href="my_friend_req.php?demande=cancel_req_from_receiver&id='.$rep2['id_user'].'" class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto text-center" type="submit" name="envoyer_ami">refuser la demande</a>';
                        echo '    <a href="my_friend_req.php?demande=be_friend&id='.$rep2['id_user'].'" class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto text-center" type="submit" name="envoyer_ami">accepter la demande</a>';
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