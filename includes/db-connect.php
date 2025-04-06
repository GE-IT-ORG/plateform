<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'geit_db';
$username = 'root';
$password = '';

try {
    // Créer une nouvelle connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configurer PDO pour qu'il lance des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configurer PDO pour qu'il retourne les résultats sous forme d'objets
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    
} catch(PDOException $e) {
    // En cas d'erreur, afficher un message et arrêter le script
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
?>