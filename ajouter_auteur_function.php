<?php
include 'connexion.php';
//Traitement du formulaire d'ajout de livre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $Nom = array("");
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

        // Redirection après le traitement du formulaire
        header("Location: ajouter_auteur_page.php");
        exit; // s'assurer que le script se termine afin de ne pas exécuter plus
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>