<?php
include 'connexion.php';
    // Récupérer les données du formulaire
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];

    try {
        // Préparer la requête SQL
        $stmt = $connexion->prepare(
            "INSERT INTO auteur (nom, prenom) 
             VALUES (:Nom, :Prenom)"
        );

        // Lier les paramètres
        $stmt->bindValue(':Nom', $Nom);
        $stmt->bindValue(':Prenom', $Prenom);

        if ($stmt->execute()) {
            echo "Nouveau auteur ajouté avec succès";
        } else {
            echo "Erreur: " . $stmt->errorInfo()[2];
        }
        exit; // s'assurer que le script se termine afin de ne pas exécuter plus
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
?>