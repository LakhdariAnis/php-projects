<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomPrenom = isset($_POST['nomPrenom']) ? trim($_POST['nomPrenom']) : '';
    $selectedLangages = isset($_POST['langages']) ? $_POST['langages'] : [];

    // Backend Validation
    if (empty($nomPrenom)) {
        die("Erreur : Le nom et prénom sont requis.");
    }

    if (empty($selectedLangages)) {
        die("Erreur : Vous devez sélectionner au moins un langage.");
    }

    // Only keep languages that exist in the database
    $allowed = $pdo->query("SELECT langage FROM langages")->fetchAll(PDO::FETCH_COLUMN);
    $selectedLangages = array_values(array_intersect((array) $selectedLangages, $allowed));

    if (empty($selectedLangages)) {
        die("Erreur : Langage inconnu.");
    }

    // Process Languages (Concatenate)
    $langagesString = implode(',', $selectedLangages);

    try {
        // Prepared Statement to prevent SQL Injection
        $stmt = $pdo->prepare("INSERT INTO developpeur_web (nomPrenom, langages) VALUES (:nomPrenom, :langages)");
        $stmt->bindParam(':nomPrenom', $nomPrenom);
        $stmt->bindParam(':langages', $langagesString);

        if ($stmt->execute()) {
            echo "<div style='color: green; font-weight: bold;'>Succès : Données insérées avec succès !</div>";
            echo "<br><a href='index.php'>Retour au formulaire</a>";
        } else {
            echo "Erreur lors de l'insertion.";
        }
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
} else {
    // Redirect if accessed directly
    header("Location: index.php");
    exit();
}
?>