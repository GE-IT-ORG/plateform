<?php
/**
 * Script pour ajouter un nouvel étudiant
 * Ce fichier traite les données du formulaire d'ajout d'étudiant
 */

require_once '../includes/db-connect.php';

// Après l'insertion réussie
if ($result) {
    $_SESSION['success_message'] = "L'étudiant a été ajouté avec succès.";
    header('Location: home_admin.php');
    exit;
}

// Vérifier si le formulaire a été soumis via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et nettoyer les données du formulaire
    $matricule = htmlspecialchars(trim($_POST['matricule']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $niveau = htmlspecialchars(trim($_POST['niveau']));
    $status = htmlspecialchars(trim($_POST['status']));
    
    // Validation des données
    $errors = [];
    
    // Vérifier si le matricule est unique
    $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE matricule = ?");
    $stmt->execute([$matricule]);
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "Ce numéro matricule existe déjà.";
    }
    
    // Vérifier si l'email est unique
    $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "Cet email est déjà utilisé.";
    }
    
    // Vérifier le format de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format d'email invalide.";
    }
    
    // Si aucune erreur, insérer l'étudiant dans la base de données
    if (empty($errors)) {
        try {
            $stmt = $conn->prepare("
                INSERT INTO user (matricule, nom, prenom, email, niveau, status, date_creation) 
                VALUES (?, ?, ?, ?, ?, ?, NOW())
            ");
            
            $result = $stmt->execute([
                $matricule,
                $nom,
                $prenom,
                $email,
                $niveau,
                $status
            ]);
            
            if ($result) {
                // Rediriger vers la page des étudiants avec un message de succès
                $_SESSION['success_message'] = "L'étudiant a été ajouté avec succès.";
                header('Location: /projetGE-IT/home_admin.php?section=etudiants');
                exit;
            } else {
                $errors[] = "Une erreur est survenue lors de l'ajout de l'étudiant.";
            }
        } catch (PDOException $e) {
            // Journaliser l'erreur et afficher un message générique
            error_log("Erreur d'ajout d'étudiant: " . $e->getMessage());
            $errors[] = "Une erreur de base de données est survenue.";
        }
    }
    
    // S'il y a des erreurs, les stocker en session et rediriger
    if (!empty($errors)) {
        $_SESSION['error_messages'] = $errors;
        $_SESSION['form_data'] = $_POST; // Pour repopuler le formulaire
        header('Location: /projetGE-IT/home_admin.php?section=etudiants');
        exit;
    }
} else {
    // Si quelqu'un accède directement à ce fichier sans passer par le formulaire
    header('Location: /projetGE-IT/home_admin.php');
    exit;
}
?>