<?php
require_once 'connexion.php';

try {
    // Supprimer les enregistrements dont la dateretour est atteinte
    $stmt = $connexion->prepare("DELETE FROM emprunter WHERE dateretour < CURDATE()");

    $stmt->execute();

    
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}
?>