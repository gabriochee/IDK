<?php
    require_once('db.php');

    if(isset($_POST['submit_img']) && isset($_FILES['image'])) {
        $id_user = $_SESSION['id_user'];
        



        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        

        $extension = pathinfo($file_name, PATHINFO_EXTENSION);

        $new_file_name = $id_user . '.' . $extension;
        $folder = '../../inc/img/user_img/' . $new_file_name;

        $req1 = $bdd->prepare("UPDATE utilisateur SET photo_utilisateur = :photo_utilisateur WHERE id_user = :id_user");
        $req1->bindParam(":photo_utilisateur", $new_file_name);
        $req1->bindParam(":id_user", $id_user);

        if($req1->execute()) {
            if(move_uploaded_file($tempname, $folder)) {
                echo "<h2>Upload réussi</h2>";
                header('Location: parameters.php');
            } else {
                echo "<h2>Upload échoué</h2>";
            }
        } else {
            echo "<h2>Erreur lors de la mise à jour de la base de données</h2>";
        }
    }
?>
