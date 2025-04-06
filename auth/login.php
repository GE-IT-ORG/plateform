<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require_once '../includes/db-connect.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $niveau = $_POST['niveau'] ?? '';
    
    // Valider les données
    if (empty($username) || empty($password) || empty($niveau)) {
        echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs.']);
        exit;
    }
    
    try {
        // Préparer la requête SQL pour vérifier les identifiants
        $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE username = :username AND mdp = :password AND niveau = :niveau");
        
        // Exécuter la requête avec les paramètres
        $stmt->execute([
            ':username' => $username,
            ':password' => $password,
            ':niveau' => $niveau
        ]);
        
        // Récupérer l'étudiant
        $etudiant = $stmt->fetch();
        
        // Vérifier si l'étudiant existe
        if ($etudiant) {
            // Enregistrer les informations de l'étudiant dans la session
            $_SESSION['etudiant_id'] = $etudiant->id;
            $_SESSION['etudiant_nom'] = $etudiant->nom;
            $_SESSION['etudiant_prenom'] = $etudiant->prenom;
            $_SESSION['etudiant_niveau'] = $etudiant->niveau;
            $_SESSION['logged_in'] = true;
            
            // Retourner une réponse de succès
            echo json_encode(['success' => true]);
        } else {
            // Retourner une réponse d'échec
            echo json_encode(['success' => false, 'message' => 'Identifiants incorrects. Veuillez réessayer.']);
        }
    } catch (PDOException $e) {
        // En cas d'erreur, retourner une réponse d'échec
        echo json_encode(['success' => false, 'message' => 'Erreur de base de données: ' . $e->getMessage()]);
    }
} else {
    // Si la méthode n'est pas POST, rediriger vers la page d'accueil
    header('Location: ../index.php');
    exit;
}
?>