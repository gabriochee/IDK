<?php
require_once('db.php');

$req_display_admin_co = $bdd->prepare("SELECT id_user, nom, prenom, pseudo FROM utilisateur WHERE id_user = :id_user;");
$req_display_admin_co->execute(array("id_user" => $_SESSION['id_user']));
$res_display_admin_co = $req_display_admin_co->fetch();
$req_display_user = $bdd->prepare("SELECT utilisateur.id_user, nom, prenom, pseudo FROM utilisateur LEFT JOIN ban ON ban.id_user = utilisateur.id_user WHERE role_user = 'utilisateur' AND supprime = 0 AND (ban.definitif = 0 OR ban.definitif IS NULL) AND (ban.date_deban < NOW() OR ban.date_deban IS NULL) GROUP BY utilisateur.id_user;");
$req_display_user->execute();
$res_display_user = $req_display_user->fetchAll();
$res_display_user = array_reverse($res_display_user);
$req_display_user_ban = $bdd->prepare("SELECT utilisateur.id_user, utilisateur.prenom, utilisateur.nom, utilisateur.pseudo FROM ban JOIN utilisateur ON ban.id_user = utilisateur.id_user WHERE supprime = 0 AND (ban.definitif = 1 OR ban.date_deban > NOW());");
$req_display_user_ban->execute();
$res_display_user_ban = $req_display_user_ban->fetchAll();
$res_display_user_ban = array_reverse($res_display_user_ban);
$req_display_admin = $bdd->prepare("SELECT id_user, nom, prenom, pseudo FROM utilisateur WHERE role_user = 'admin' AND supprime = 0;");
$req_display_admin->execute();
$res_display_admin = $req_display_admin->fetchAll();
$res_display_admin = array_reverse($res_display_admin);
function updateUser($bdd)
{
    if (isset($_POST['id_user'])) {
        try {
            $req_update = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, pseudo = :pseudo, sexe = :sexe, date_naissance = :date_naissance, mail = :mail, telephone = :telephone WHERE id_user = :id_user";
            $update = $bdd->prepare($req_update);
            $update->execute([
                'nom' => $_POST['lastName'],
                'prenom' => $_POST['firstName'],
                'pseudo' => $_POST['username'],
                'sexe' => $_POST['sexe'],
                'date_naissance' => "{$_POST['birthday-year']}-{$_POST['birthday-month']}-{$_POST['birthday-day']}",
                'mail' => $_POST['email'],
                'telephone' => $_POST['phone'],
                'id_user' => $_POST['id_user']
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
function banUser($bdd)
{
    if (isset($_POST['ban-id'])) {
        $req_ban = "INSERT INTO ban(definitif, date_ban, date_deban, raison, id_user) VALUES (:definitif, :dateban, :datedeban, :raison, :id_user)";
        $prep = $bdd->prepare($req_ban);
        $prep->bindValue(":id_user", intval($_POST['ban-id']));
        $prep->bindValue(":definitif", (isset($_POST['definitif']) ? 1 : 0));
        $prep->bindValue(":dateban", date("Y-m-d H-i-s"));

        $interval = new DateInterval('P' . $_POST['ban-time-year'] . 'Y' . $_POST['ban-time-month'] . 'M' . $_POST['ban-time-day'] . 'DT' . $_POST['ban-time-hour'] . 'H' . $_POST['ban-time-minute'] . 'M' . $_POST['ban-time-second'] . 'S');
        $date_deban = (new DateTime('now'))->add($interval);

        $prep->bindValue(":datedeban", $date_deban->format("Y-m-d H-i-s"));
        $prep->bindParam(":raison", $_POST['raison']);

        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
function deleteUser($bdd)
{
    if (isset($_POST['delete-id'])) {
        $req_delete = "UPDATE utilisateur SET supprime = 1 WHERE id_user = :id";
        $prep = $bdd->prepare($req_delete);
        $prep->bindValue(":id", $_POST['delete-id']);

        try {
            $prep->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
function unbanUser($bdd)
{
    if (isset($_POST['unban-id'])) {
        $req_deban = $bdd->prepare("UPDATE ban SET date_deban = NOW(), definitif = FALSE WHERE id_user = :id_user ORDER BY id_ban DESC LIMIT 1;");
        $req_deban->bindParam(":id_user", $_POST['unban-id']);
        $req_deban->execute();
    }
}
function createAdmin($bdd) 
{
    if(isset($_POST['push_data_admin'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $pseudo = $_POST['pseudo'];
        $role_user = 'admin';
        $sexe = $_POST['sexe-admin'];
        $mail = $_POST['mail'];
        $phone = $_POST['phone-admin'];
        $date_naissance = $_POST['date_naissance'];
        $pepper = 'sZB8J0az0z';
        $hash = password_hash($_POST['mdp'] . $pepper, PASSWORD_BCRYPT, ['cost' => 13]);
        $date_inscription = date('Y-m-d H:i:s');

        $req = $bdd->prepare("INSERT INTO utilisateur (role_user, nom, prenom, pseudo, sexe, date_naissance, mail, telephone, date_inscription, mdp, photo_utilisateur, supprime, statut_newsletter) VALUES (:role_user, :nom, :prenom, :pseudo, :sexe, :date_naissance, :mail, :phone, :date_inscription, :mdp, 'profile.svg', '0', '0')");
        $req->bindParam(':role_user', $role_user);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':pseudo', $pseudo);
        $req->bindParam(':sexe', $sexe);
        $req->bindParam(':date_naissance', $date_naissance);
        $req->bindParam(':mail', $mail);
        $req->bindParam(':phone', $phone);
        $req->bindParam(':date_inscription', $date_inscription);
        $req->bindParam(':mdp', $hash);

        try {
            $req->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

function updatePhoto($bdd) {
    if(isset($_POST['submit_img']) && isset($_FILES['image'])) {
        $id_user = $_POST['id_user_for_img'];
        
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);

        if(strtoupper($extension) != 'PNG') {
            echo "<h2>Seuls les fichiers PNG sont acceptés t'as essayé de me scriptéééé JOHANNN</h2>";
            exit();
        }

        $new_file_name = $id_user . '.' . $extension;
        $folder = '../../inc/img/user_img/' . $new_file_name;

        $req1 = $bdd->prepare("UPDATE utilisateur SET photo_utilisateur = :photo_utilisateur WHERE id_user = :id_user");
        $req1->bindParam(":photo_utilisateur", $new_file_name);
        $req1->bindParam(":id_user", $id_user);

        if($req1->execute()) {
            if(move_uploaded_file($tempname, $folder)) {
                echo "<h2>Upload réussi</h2>";
                header('Location: ../../admin/moderation_user.php');
            } else {
                echo "<h2>Upload échoué</h2>";
            }
        } else {
            echo "<h2>Erreur lors de la mise à jour de la base de données</h2>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    updatePhoto($bdd);
    updateUser($bdd);
    banUser($bdd);
    deleteUser($bdd);
    unbanUser($bdd);
    createAdmin($bdd);
}
?>
