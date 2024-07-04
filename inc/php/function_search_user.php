<?php
    require_once("db.php");
    require_once("log.php");
    
    

    $req1 = $bdd->prepare("SELECT pseudo, nom, prenom, id_user FROM utilisateur");
    $req1->execute();
    $rep1 = $req1->fetchAll();

    //on veut afficher ceux qui nous ont envoyé donc utilisateur.id_user = demande_ami.envoyeur quand c a nous que l'on a envoyé donc "receveur"=>$_SESSION['id_user']
    $req2 = $bdd->prepare("SELECT pseudo, nom, prenom, id_user FROM utilisateur INNER JOIN demande_ami ON utilisateur.id_user = demande_ami.envoyeur WHERE demande_ami.receveur = :receveur AND statut_demande = 'En attente'");
    $req2->execute(
        array(
            "receveur"=>$_SESSION['id_user']
            )
    );
    $rep2 = $req2->fetchAll();

    //les demandes d'ami pour nous
    $req3 = $bdd->prepare("SELECT pseudo, nom, prenom, id_user FROM utilisateur INNER JOIN demande_ami ON utilisateur.id_user = demande_ami.receveur WHERE demande_ami.envoyeur = :envoyeur");
    $req3->execute(
        array(
            "envoyeur"=>$_SESSION['id_user']
            )
    );
    $rep3 = $req3->fetchAll();
    
    //aficher nos amis
    $req4 = $bdd->prepare("SELECT pseudo, nom, prenom, id_user,photo_utilisateur FROM utilisateur INNER JOIN ami ON (utilisateur.id_user = ami.id_user_1 AND ami.id_user_2 = :me) OR (utilisateur.id_user = ami.id_user_2 AND ami.id_user_1 = :me) WHERE utilisateur.id_user != :me");
    $req4->execute(
        array(
            "me"=>$_SESSION['id_user']
        )
    );
    $rep4 = $req4->fetchAll();

    if(isset($_GET['demande']) && isset($_GET['id'])){
        
        if(isset($_SESSION['id_user'])){
            
            if ($_GET['demande'] === 'attente_demande_ami') {
                try {
                    envoyer_demande($_SESSION['id_user'], $_GET['id'], $bdd);
                    header('Location: my_friend_list.php');
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
            }
            else if($_GET['demande'] === 'cancel_req'){
                try{
                    cancel_request($_SESSION['id_user'], $_GET['id'], $bdd);
                    header('Location: my_friend_list.php');
                }catch(PDOException $e){
                    die($e->getMessage());
                }
            }
            else if($_GET['demande'] === 'cancel_req_from_receiver'){
                try{
                    cancel_request($_GET['id'],$_SESSION['id_user'], $bdd);
                    header('Location: my_friend_list.php');
                }catch(PDOException $e){
                    die($e->getMessage());
                }
            }
            else if($_GET['demande'] === 'be_friend'){
                try{
                    being_friend($_SESSION['id_user'],$_GET['id'], $bdd);
                    cancel_request( $_GET['id'],$_SESSION['id_user'], $bdd);
                    cancel_request($_SESSION['id_user'], $_GET['id'], $bdd);
                    header('Location: my_friend_list.php');
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
            }
            else if($_GET['demande'] === 'supp_friend'){
                try{
                    supp_friend($_SESSION['id_user'],$_GET['id'], $bdd);
                    header('Location: my_friend_list.php');
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
            }
        }        
    }
    function being_friend($my_user_id, $other_user_id, $bdd){
        try{
            $devenir_ami="INSERT INTO ami(id_user_1, id_user_2, date_amitie) VALUES (:me, :other, NOW())";
            $stmt = $bdd->prepare($devenir_ami);
            $stmt->bindParam(':me', $my_user_id);
            $stmt->bindParam(':other', $other_user_id);
            $stmt->execute();
            server_log($my_user_id . " est devenu ami avec " . $other_user_id);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function envoyer_demande($my_user_id, $other_user_id, $bdd) {
        try{
            $demande_ami = "INSERT INTO demande_ami(envoyeur, receveur) VALUES (:me, :other)";
            $stmt = $bdd->prepare($demande_ami);
            $stmt->bindParam(':me', $my_user_id);
            $stmt->bindParam(':other', $other_user_id);
            $stmt->execute();
            server_log($my_user_id . " a demandé en ami " . $other_user_id);
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
        
    }

    function check_friend_request_status_from_me($my_user_id, $other_user_id, $bdd) {
        try {
            $check_status_friend = "SELECT COUNT(*) FROM demande_ami WHERE envoyeur = :me AND receveur = :other";
            $stmt = $bdd->prepare($check_status_friend);
            $stmt->bindParam(':me', $my_user_id);
            $stmt->bindParam(':other', $other_user_id);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function check_friend_request_status_from_other($my_user_id, $other_user_id, $bdd) {
        try {
            $check_status_friend = "SELECT COUNT(*) FROM demande_ami WHERE envoyeur = :other AND receveur = :me";
            $stmt = $bdd->prepare($check_status_friend);
            $stmt->bindParam(':me', $my_user_id);
            $stmt->bindParam(':other', $other_user_id);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    function cancel_request($my_user_id, $other_user_id, $bdd){
        try{
            $cancel_request= $bdd->prepare("UPDATE demande_ami SET statut_demande ='Refuser' WHERE envoyeur=:me AND receveur= :other");
            $cancel_request->bindParam(':me', $my_user_id);
            $cancel_request->bindParam(':other', $other_user_id);
            $cancel_request->execute();
            server_log($my_user_id . " a décliné la demande d'ami de " . $other_user_id);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function is_friend_already($my_user_id, $other_user_id, $bdd){
        try{
            $check_friend = $bdd->prepare("SELECT COUNT(*) FROM ami WHERE (id_user_1= :me AND id_user_2=:other) OR (id_user_2= :me AND id_user_1= :other)");
            $check_friend->bindParam(':me', $my_user_id);
            $check_friend->bindParam(':other', $other_user_id);
            $check_friend->execute();
            return $check_friend->fetchColumn() > 0;
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function supp_friend($my_user_id, $other_user_id, $bdd){
        try{
            $supp_friend = $bdd->prepare("DELETE FROM ami WHERE (id_user_1= :me AND id_user_2=:other) OR (id_user_2= :me AND id_user_1= :other)");
            $supp_friend->bindParam(':me', $my_user_id);
            $supp_friend->bindParam(':other', $other_user_id);
            $supp_friend->execute();
            server_log($my_user_id . " a supprimé l'utilisateur suivant de ses amis : " . $other_user_id);
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
        
    }
    
?>