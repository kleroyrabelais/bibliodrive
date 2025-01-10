<?php
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['mel']) && isset($_SESSION['panier'])) {
    $mel = $_SESSION['mel'];
    $livres = $_SESSION['panier'];

    // Insérer les livres réservés dans la base de données
    try {
        foreach ($livres as $livre) {
            // Définir les dates d'emprunt et de retour
            $dateemprunt = date('Y-m-d');
            $dateretour = date('Y-m-d', strtotime('+3 weeks'));

            // Insérer la réservation dans la base de données
            $stmt = $connexion->prepare(
                "INSERT INTO emprunter (mel, nolivre, dateemprunt, dateretour) 
                 VALUES (:mel, :nolivre, :dateemprunt, :dateretour)"
            );
            $stmt->bindValue(':mel', $mel);
            $stmt->bindValue(':nolivre', $livre['nolivre']);
            $stmt->bindValue(':dateemprunt', $dateemprunt);
            $stmt->bindValue(':dateretour', $dateretour);
            $stmt->execute();
        }

        // Vider le panier de la session
        unset($_SESSION['panier']);

        // Redirection vers la page panier
        header("Location: panier.php?confirmed=true");
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }
} else {
    echo "Accès non autorisé.";
}
?>