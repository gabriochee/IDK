<?php
// Devenir vraiment ami
function being_friend($my_user_id, $other_user_id, $bdd) {
    try {
        $devenir_ami = "INSERT INTO ami(id_user_1, id_user_2) VALUES (:me, :other)";
        $stmt = $bdd->prepare($devenir_ami);
        $stmt->bindParam(':me', $my_user_id, PDO::PARAM_INT);
        $stmt->bindParam(':other', $other_user_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        handle_error($e->getMessage());
    }
}

// Demande en attente
function envoyer_demande($my_user_id, $other_user_id, $bdd) {
    try {
        $demande_ami = "INSERT INTO demande_ami(envoyeur, receveur) VALUES (:me, :other)";
        $stmt = $bdd->prepare($demande_ami);
        $stmt->bindParam(':me', $my_user_id, PDO::PARAM_INT);
        $stmt->bindParam(':other', $other_user_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        handle_error($e->getMessage());
    }
}

// Regarder s'il y a une demande d'ami en attente
function check_friend_request_status($my_user_id, $other_user_id, $bdd) {
    try {
        $check_status_friend = "SELECT COUNT(*) FROM demande_ami WHERE envoyeur = :me AND receveur = :other";
        $stmt = $bdd->prepare($check_status_friend);
        $stmt->bindParam(':me', $my_user_id, PDO::PARAM_INT);
        $stmt->bindParam(':other', $other_user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        handle_error($e->getMessage());
    }
}

// Annuler la demande d'ami en attente
function cancel_request($my_user_id, $other_user_id, $bdd) {
    try {
        $cancel_request = $bdd->prepare("DELETE FROM demande_ami WHERE envoyeur = :me AND receveur = :other");
        $cancel_request->bindParam(':me', $my_user_id, PDO::PARAM_INT);
        $cancel_request->bindParam(':other', $other_user_id, PDO::PARAM_INT);
        $cancel_request->execute();
    } catch (PDOException $e) {
        handle_error($e->getMessage());
    }
}

// Check si on est déjà ami avec cette personne
function is_friend_already($my_user_id, $other_user_id, $bdd) {
    try {
        $check_friend = $bdd->prepare("SELECT COUNT(*) FROM ami WHERE (id_user_1 = :me AND id_user_2 = :other) OR (id_user_2 = :me AND id_user_1 = :other)");
        $check_friend->bindParam(':me', $my_user_id, PDO::PARAM_INT);
        $check_friend->bindParam(':other', $other_user_id, PDO::PARAM_INT);
        $check_friend->execute();
        return $check_friend->fetchColumn() > 0;
    } catch (PDOException $e) {
        handle_error($e->getMessage());
    }
}

// Supprimer un ami
function supp_friend($my_user_id, $other_user_id, $bdd) {
    try {
        $supp_friend = $bdd->prepare("DELETE FROM ami WHERE (id_user_1 = :me AND id_user_2 = :other) OR (id_user_2 = :me AND id_user_1 = :other)");
        $supp_friend->bindParam(':me', $my_user_id, PDO::PARAM_INT);
        $supp_friend->bindParam(':other', $other_user_id, PDO::PARAM_INT);
        $supp_friend->execute();
    } catch (PDOException $e) {
        handle_error($e->getMessage());
    }
}

// Fetch users
try {
    $req1 = $bdd->prepare("SELECT pseudo, nom, prenom, id_user FROM utilisateur");
    $req1->execute();
    $rep1 = $req1->fetchAll();
} catch (PDOException $e) {
    handle_error($e->getMessage());
}

// On veut afficher ceux qui nous ont envoyé donc utilisateur.id_user = demande_ami.envoyeur quand c a nous que l'on a envoyé donc "receveur"=>$_SESSION['id_user']
try {
    $req2 = $bdd->prepare("SELECT pseudo, nom, prenom, id_user FROM utilisateur INNER JOIN demande_ami ON utilisateur.id_user = demande_ami.envoyeur WHERE demande_ami.receveur = :receveur");
    $req2->bindValue(':receveur', $_SESSION['id_user'], PDO::PARAM_INT);
    $req2->execute();
    $rep2 = $req2->fetchAll();
} catch (PDOException $e) {
    handle_error($e->getMessage());
}

// On veut afficher ceux que nous avons fait une demande d'ami
try {
    $req3 = $bdd->prepare("SELECT pseudo, nom, prenom, id_user FROM utilisateur INNER JOIN demande_ami ON utilisateur.id_user = demande_ami.receveur WHERE demande_ami.envoyeur = :envoyeur");
    $req3->bindValue(':envoyeur', $_SESSION['id_user'], PDO::PARAM_INT);
    $req3->execute();
    $rep3 = $req3->fetchAll();
} catch (PDOException $e) {
    handle_error($e->getMessage());
}

// On veut afficher nos amis
try {
    $req4 = $bdd->prepare("SELECT pseudo, nom, prenom, id_user FROM utilisateur INNER JOIN ami ON (utilisateur.id_user = ami.id_user_1 AND ami.id_user_2 = :me) OR (utilisateur.id_user = ami.id_user_2 AND ami.id_user_1 = :me) WHERE utilisateur.id_user != :me");
    $req4->bindValue(':me', $_SESSION['id_user'], PDO::PARAM_INT);
    $req4->execute();
    $rep4 = $req4->fetchAll();
} catch (PDOException $e) {
    handle_error($e->getMessage());
}

// Vérifier si le get de demande et id ont bien récupéré une valeur
if (isset($_GET['demande']) && isset($_GET['id'])) {
    if (isset($_SESSION['id_user'])) {
        if ($_GET['demande'] === 'attente_demande_ami') {
            try {
                envoyer_demande($_SESSION['id_user'], $_GET['id'], $bdd);
            } catch (PDOException $e) {
                handle_error($e->getMessage());
            }
        }
        if ($_GET['demande'] === 'cancel_req') {
            try {
                cancel_request($_SESSION['id_user'], $_GET['id'], $bdd);
            } catch (PDOException $e) {
                handle_error($e->getMessage());
            }
        }
        if ($_GET['demande'] === 'cancel_req_from_receiver') {
            try {
                cancel_request($_GET['id'], $_SESSION['id_user'], $bdd);
            } catch (PDOException $e) {
                handle_error($e->getMessage());
            }
        }
        if ($_GET['demande'] === 'be_friend') {
            try {
                being_friend($_SESSION['id_user'], $_GET['id'], $bdd);
                cancel_request($_GET['id'], $_SESSION['id_user'], $bdd);
                cancel_request($_SESSION['id_user'], $_GET['id'], $bdd);
            } catch (PDOException $e) {
                handle_error($e->getMessage());
            }
        }
        if ($_GET['demande'] === 'supp_friend') {
            try {
                supp_friend($_SESSION['id_user'], $_GET['id'], $bdd);
            } catch (PDOException $e) {
                handle_error($e->getMessage());
            }
        }
    } else {
        handle_error();
    }
}

?>
