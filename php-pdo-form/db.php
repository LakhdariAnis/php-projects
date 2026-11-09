<?php
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = 'testwebdb';
$username = 'root'; // Assuming default XAMPP/WAMP settings
$password = '';     // Assuming default XAMPP/WAMP settings

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Enable exceptions for errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
