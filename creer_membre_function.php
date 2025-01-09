<?php
// Initialiser les variables pour éviter les avertissements
//traitment du formulaire de création de membre
$mel = $motdepasse = $nom = $prenom = $adresse = $ville = $codepostal = $profil = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $mel = $_POST['mel'];
    $motdepasse = $_POST['motdepasse'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $codepostal = $_POST['codepostal'];

    include 'connexion.php';

    // Vérifier si l'utilisateur est un admin ou un client
    if (strpos($mel, '@admin.fr') !== false) {
        $profil = 'admin';
    } else {
        $profil = 'client';
    }

    try {
        // Préparer la requête SQL
        $stmt = $connexion->prepare(
            "INSERT INTO utilisateur (mel, motdepasse, nom, prenom, adresse, ville, codepostal, profil) 
             VALUES (:mel, :motdepasse, :nom, :prenom, :adresse, :ville, :codepostal, :profil)"
        );

        // Lier les paramètres
        $stmt->bindValue(":mel", $mel);
        $stmt->bindValue(":motdepasse", $motdepasse);
        $stmt->bindValue(":nom", $nom);
        $stmt->bindValue(":prenom", $prenom);
        $stmt->bindValue(":adresse", $adresse);
        $stmt->bindValue(":ville", $ville);
        $stmt->bindValue(":codepostal", $codepostal);
        $stmt->bindValue(":profil", $profil);

        $stmt->execute();

        // Redirection après le traitement du formulaire
        header("Location: creer_membre_page.php");
        exit; //s'assurer que le scipt se finisse afin de ne pas éxécuter plus
    } catch (PDOException $e) {

        echo "Erreur : " . $e->getMessage();
    }
}
?>
