<?php
session_start();
require '../includes/db-connect.php';

header('Content-Type: application/json');  // On indique qu'on retourne du JSON

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nettoyage des champs
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');
    $niveau = trim($_POST["niveau"] ?? '');

    if (empty($username) || empty($password) || empty($niveau)) {
        echo json_encode([
            "success" => false,
            "message" => "Tous les champs sont requis."
        ]);
        exit;
    }

    try {
        // Requête sécurisée
        $query = $conn->prepare("SELECT id_etudiant, username, mdp, niveau FROM etudiants WHERE username = ? AND niveau = ?");
        $query->execute([$username, $niveau]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($password === $user['mdp']) {
                // Connexion OK
                $_SESSION["id_etudiant"] = $user["id_etudiant"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["niveau"] = $niveau;

                echo json_encode([
                    "success" => true,
                    "message" => "Connexion réussie."
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Mot de passe incorrect."
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Utilisateur non trouvé."
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            "success" => false,
            "message" => "Erreur de connexion à la base de données."
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Requête invalide."
    ]);
}
