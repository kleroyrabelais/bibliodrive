<?php
include 'connexion.php';
//Traitement du formulaire d'ajout de livre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $noauteur = $_POST['noauteur'];
    $titre = $_POST['titre'];
    $isbn13 = $_POST['isbn13'];
    $anneeparution = $_POST['anneeparution'];
    $detail = $_POST['detail'];
    $photo = $_POST['photo'];

    try {
        // Préparer la requête SQL
        $stmt = $connexion->prepare(
            "INSERT INTO livre (noauteur, titre, isbn13, anneeparution, detail, photo) 
             VALUES (:noauteur, :titre, :isbn13, :anneeparution, :detail, :photo)"
        );

        // Lier les paramètres
        $stmt->bindValue(':noauteur', $noauteur);
        $stmt->bindValue(':titre', $titre);
        $stmt->bindValue(':isbn13', $isbn13);
        $stmt->bindValue(':anneeparution', $anneeparution);
        $stmt->bindValue(':detail', $detail);
        $stmt->bindValue(':photo', $photo);

        if ($stmt->execute()) {
            echo "Nouveau livre ajouté avec succès";
        } else {
            echo "Erreur: " . $stmt->errorInfo()[2];
        }

        // Redirection après le traitement du formulaire
        header("Location: ajouter_livre_page.php");
        exit; // s'assurer que le script se termine afin de ne pas exécuter plus
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>