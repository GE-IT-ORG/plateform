<?php
/**
 * Script pour supprimer un étudiant
 * Ce fichier traite la suppression d'un étudiant par son ID
 */

// Inclure le fichier de configuration de la base de données
require_once '../includes/db-connect.php';

// Vérifier si l'utilisateur est connecté et a les droits d'administrateur
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    // Rediriger vers la page de connexion si non autorisé
    $_SESSION['error_message'] = "Vous n'avez pas les droits pour effectuer cette action.";
    header('Location: login.php');
    exit;
}

// Vérifier si l'ID de l'étudiant est fourni
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    try {
        // Option 1: Suppression physique de l'étudiant
        // $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
        
        // Option 2: Suppression logique (recommandée) - marquer comme supprimé plutôt que de supprimer réellement
        $stmt = $pdo->prepare("UPDATE user SET status = 'Supprimé', date_modification = NOW() WHERE id_user = ?");
        
        $result = $stmt->execute([$id]);
        
        if ($result && $stmt->rowCount() > 0) {
            // Suppression réussie
            $_SESSION['success_message'] = "L'étudiant a été supprimé avec succès.";
        } else {
            // Aucune ligne affectée, l'étudiant n'existe peut-être pas
            $_SESSION['error_message'] = "Étudiant introuvable ou déjà supprimé.";
        }
    } catch (PDOException $e) {
        // Journaliser l'erreur et afficher un message générique
        error_log("Erreur de suppression d'étudiant: " . $e->getMessage());
        $_SESSION['error_message'] = "Une erreur est survenue lors de la suppression.";
        
        // Si l'erreur est due à une contrainte de clé étrangère
        if ($e->getCode() == '23000') {
            $_SESSION['error_message'] = "Impossible de supprimer cet étudiant car il est référencé dans d'autres tables.";
        }
    }
} else {
    // ID non fourni ou invalide
    $_SESSION['error_message'] = "ID d'étudiant invalide.";
}

// Rediriger vers la page des étudiants
header('Location: index.php?section=etudiants');
exit;
?>