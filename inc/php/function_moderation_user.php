<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['connected']) || $_SESSION['connected'] != 'connected' || $_SESSION['role_user'] != 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Problèmes d\'identifications vous n\'avez pas accès']);
    exit;
}

if (!isset($_GET['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Aucun ID fournis']);
    exit;
}

$userId = $_GET['id'];

try {
    $stmt = $bdd->prepare("
        SELECT DISTINCT
    u.id_user, 
    u.nom, 
    u.prenom, 
    u.date_naissance, 
    u.sexe, 
    u.pseudo, 
    u.mail, 
    u.mdp, 
    u.date_inscription, 
    u.photo_utilisateur, 
    u.statut_newsletter, 
    u.moyenne_age_ami, 
    u.majorite_genre_ami, 
    u.verification_code, 
    u.telephone, 
    u.derniere_connexion, 
    b.id_ban, 
    b.date_ban, 
    b.date_deban, 
    b.raison, 
    (SELECT COUNT(*) FROM demande_ami WHERE (receveur = u.id_user OR envoyeur = u.id_user) AND statut_demande = 'En attente') AS nombre_demandes_amis, 
    (SELECT COUNT(*) FROM demande_ami WHERE (receveur = u.id_user OR envoyeur = u.id_user) AND statut_demande = 'Refuser') AS nombre_demandes_refusees, 
    (SELECT COUNT(*) FROM listes WHERE statut = 'publique' AND id_user = :id_user) AS nombre_listes_publique, 
    (SELECT COUNT(*) FROM listes WHERE statut = 'privé' AND id_user = :id_user) AS nombre_listes_privee, 
    (SELECT COUNT(*) FROM listes WHERE statut = 'amis seulement' AND id_user = :id_user) AS nombre_listes_only_amis, 
    (SELECT COUNT(*) FROM avis WHERE statut = 'publique' AND id_user = :id_user) AS nombre_avis_publique, 
    (SELECT COUNT(*) FROM avis WHERE statut = 'privee' AND id_user = :id_user) AS nombre_avis_privee,
    (SELECT COUNT(*) FROM ami WHERE id_user_1 = u.id_user OR id_user_2 = u.id_user) AS nombre_amis
FROM 
    utilisateur u
LEFT JOIN 
    ban b ON u.id_user = b.id_user
LEFT JOIN 
    listes l ON u.id_user = l.id_user
LEFT JOIN 
    ami am ON u.id_user = am.id_user_1 OR u.id_user = am.id_user_2
LEFT JOIN 
    demande_ami da ON u.id_user = da.receveur OR u.id_user = da.envoyeur
LEFT JOIN 
    avis a ON u.id_user = a.id_user
WHERE 
    u.id_user = :id_user;
");
    $stmt->execute(['id_user' => $userId]);
    $user = $stmt->fetch();
    
    if ($user) {
        echo json_encode(['status' => 'success', 'user' => $user]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Utilisateur introuvable']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>