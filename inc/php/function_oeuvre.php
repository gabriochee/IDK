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
    $averageRating = $rep4["averageRating"] / 2;
    $partie_decimale = fmod($averageRating, 1);
    $partie_entiere = intval($averageRating);

    $rep5 = getMovieCrew('actor');
    $rep6 = getMovieCrew('director');
    $rep7 = getMovieCrew('producer');

} else {
    header("location: home.php"); 
    exit(); 
}
?>