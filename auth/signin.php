<?php
session_start();
require '../includes/db-connect.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $mdp = trim($_POST["mdp"]);
    $niveau = trim($_POST["niveau"]);

    // Vérifier si l'utilisateur existe dans la base de données
    try {
        // Préparer la requête pour récupérer l'utilisateur en fonction du username et du niveau
        $query = $conn->prepare("SELECT id_etudiant, username, mdp FROM etudiants WHERE username = ? AND niveau = ?");
        $query->execute([$username, $niveau]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($mdp, $user['mdp'])) {
            // Enregistrer les informations de l'utilisateur dans la session
            $_SESSION["id_etudiant"] = $user["id_etudiant"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["niveau"] = $niveau;

            // Rediriger vers la page d'accueil
            header("Location: ../home.php");
            exit();
        } else {
            // Message d'erreur si les identifiants sont incorrects
            echo "Identifiants incorrects.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur lors de l'exécution de la requête
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
    }
}
?>
