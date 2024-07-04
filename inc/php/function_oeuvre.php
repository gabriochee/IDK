<?php 

function getMovieCrew($role){
    global $bdd;

    $req = $bdd->prepare("SELECT name_basics.name, work_principals.category FROM work_principals JOIN name_basics ON work_principals.id_person = name_basics.id_person WHERE id_work = :id_work AND category = '$role';");
    $req->bindParam(":id_work", $_GET['mv']);
    $req->execute();

    return $req->fetchAll();
}

if(isset($_GET['mv'])) {
    $req1 = $bdd->query("SELECT primaryTitle, startYear, runtimeMinutes FROM work_basics WHERE id_work = {$_GET['mv']}");
    $rep1 = $req1->fetch();
    //$req2 = $bdd->query("SELECT region, language FROM work_akas WHERE id_work = {$_GET['mv']};");
    //$rep2 = $req2->fetch();
    $req3 = $bdd->query("SELECT genre FROM work_genres WHERE id_work = {$_GET['mv']}");
    $rep3 = $req3->fetchAll(); 
    $req4 = $bdd->query("SELECT averageRating, numVotes FROM work_ratings WHERE id_work = {$_GET['mv']}");
    $rep4 = $req4->fetch(); 
    $req8 = null;
    $rep9 = null;

    $myRating;
    $myPartie_decimale;
    $myPartie_entiere;

    $myFriendsRating;
    $myFriendsPartie_decimale;
    $myFriendsPartie_entiere;


    if (isset($_SESSION['id_user'])){
        $req8 = $bdd->prepare('SELECT note, statut FROM avis WHERE id_user = :id_user AND id_work = :id_work;');
        $req8->bindParam(":id_user", $_SESSION['id_user']);
        $req8->bindParam(":id_work", $_GET['mv']);
        $req8->execute();
        $rep8 = $req8->fetch();

        $req9 = $bdd->prepare('SELECT AVG(note), COUNT(id_user) FROM avis JOIN ami ON avis.id_user = ami.id_user_1 WHERE id_work = :id_work AND id_user != :id_user AND statut IN (\'publique\', \'amis seulement\') AND (id_user_1 = :id_user OR id_user_2 = :id_user);');
        $req9->bindParam(":id_user", $_SESSION['id_user']);
        $req9->bindParam(":id_work", $_GET['mv']);
        $req9->execute();
        $rep9 = $req9->fetch();

        if ($rep8){
            $statut = $rep8['statut'];
            $myRating = $rep8["note"] / 2;
            $myPartie_decimale = fmod($myRating, 1);
            $myPartie_entiere = intval($myRating);
        }

        if ($rep9) {
            $myFriendsRating = $rep9['AVG(note)'] / 2;
            $myFriendsPartie_decimale = fmod($myFriendsRating, 1);
            $myFriendsPartie_entiere = intval($myFriendsRating);
        }
    }

    $averageRating = $rep4["averageRating"] / 2;
    $partie_decimale = fmod($averageRating, 1);
    $partie_entiere = intval($averageRating);

    $rep5 = getMovieCrew('actor');
    $rep6 = getMovieCrew('director');
    $rep7 = getMovieCrew('producer');

} else {
    //header("location: home.php"); 
    exit(); 
}
?>