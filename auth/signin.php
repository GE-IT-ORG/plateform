<?php
session_start();
require '../includes/db-connect.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');
    $niveau = trim($_POST["niveau"] ?? '');


    if (empty($username) || empty($password)) {
        echo json_encode([
            "success" => false,
            "message" => "Tous les champs sont requis."
        ]);
        exit;
    }

    try {
        $query = $conn->prepare("SELECT id_user, username, mdp, niveau, role FROM user WHERE username = ? AND niveau = ?");
        $query->execute([$username, $niveau]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($password === $user['mdp']) {
                
                $_SESSION["id_user"] = $user["id_user"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["niveau"] = $user["niveau"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["logged_in"] = true;

                // Détermine la page de redirection
                $redirect = ($user["role"] === "admin") ? "../projetGE-IT/home_admin.php" : "../projetGE-IT/home_etudiant.php";

                echo json_encode([
                    "success" => true,
                    "message" => "Connexion réussie.",
                    "redirect" => $redirect
                ]);
                exit;
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Mot de passe incorrect."
                ]);
                exit;
            }
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Utilisateur non trouvé."
            ]);
            exit;
        }
    } catch (PDOException $e) {
        echo json_encode([
            "success" => false,
            "message" => "Erreur de connexion à la base de données: " . $e->getMessage()
        ]);
        exit;
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Requête invalide."
    ]);
    exit;
}
