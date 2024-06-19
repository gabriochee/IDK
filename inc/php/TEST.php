<?php 
/// Les œuvres partager par l’utilisateur : coefficient 2,5 /Les listes personnels utilisateur : coefficient 1,5



// Recommandations question : si user connecter enregistrement dans recommandations dans "fonctions_questions.php"

//	Les recommandations questionnaires : coefficient 2 
// verifier si on vient avec le fecth de questionnaire
if (isset($_SESSION['connected'])) {
    $nameList = $bdd->prepare("SELECT id_list FROM listes WHERE id_nameList = :id_user");
    $nameList->execute(['id_user' => $_SESSION['id_user']]);
    $res_nameList = $nameList->fetch();

    if ($res_nameList) {
        $id_list = $res_nameList['id_list'];

        foreach ($movies as $movie) {
            $user = $bdd->prepare("INSERT INTO elem_list(id_liste, id_work, date_ajout, detail) VALUES(:id_list, :id_work, NOW(), 'questionnaire')");
            $user->execute([
                'id_list' => $id_list,
                'id_work' => $movie
            ]);
        }
    } 
}
//Les recherches utilisateur : coefficient 2,5 
// verifier si on viens avec le fetch de search_movie.php 
?>