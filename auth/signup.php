<?php
session_start(); // Pour gérer les sessions
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../includes/db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des champs
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $numero = trim($_POST["numero"]);
    
    // Vérifier si tous les champs sont remplis
    if (empty($nom) || empty($email) || empty($password) || empty($numero)) {
        die("Tous les champs sont obligatoires !");
    }

    // Vérifier si l'email est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Format d'email invalide !");
    }

    // Hachage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Gestion de la photo
    $photo_path = "uploads/default.png"; // Image par défaut
    if (!empty($_FILES["photo"]["name"])) {
        $target_dir = "uploads/"; // Dossier où stocker les images
        $photo_name = basename($_FILES["photo"]["name"]);
        $photo_tmp = $_FILES["photo"]["tmp_name"];
        $photo_size = $_FILES["photo"]["size"];
        $photo_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
        $photo_path = $target_dir . uniqid() . "." . $photo_ext; // Nom unique

        // Vérification des extensions et taille
        $allowed_exts = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($photo_ext, $allowed_exts)) {
            die("Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés !");
        }
        if ($photo_size > 2 * 1024 * 1024) { // Limite à 2 Mo
            die("L'image est trop grande (max 2 Mo) !");
        }

        // Déplacer l'image dans le dossier
        if (!move_uploaded_file($photo_tmp, $photo_path)) {
            die("Erreur lors de l'upload de la photo !");
        }
    }

    try {
        // Insérer l'étudiant dans la base de données
        $stmt = $pdo->prepare("INSERT INTO etudiants (nom, email, password, photo) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $email, $hashed_password, $photo_path]);

        // Récupérer l'ID de l'étudiant inscrit
        $last_id = $pdo->lastInsertId();

        // Stocker les infos en session
        $_SESSION["id"] = $last_id;
        $_SESSION["nom"] = $nom;
        $_SESSION["email"] = $email;
        $_SESSION["photo"] = $photo_path;

        // Redirection vers home.php
        header("Location: home.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <form action="inscription.php" method="post" enctype="multipart/form-data">
        <label>Nom :</label>
        <input type="text" name="nom" required><br>

        <label>Email :</label>
        <input type="email" name="email" required><br>

        <label>Mot de passe :</label>
        <input type="password" name="password" required><br>

        <label>Photo :</label>
        <input type="file" name="photo" accept="image/*"><br>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
