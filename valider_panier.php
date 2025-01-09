<?php
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['mel'])) {
    $mel = $_SESSION['mel'];

    // Récupérer les livres réservés par l'utilisateur
    try {
        $stmt = $connexion->prepare(
            "SELECT e.nolivre 
             FROM emprunter e
             WHERE e.mel = :mel"
        );
        $stmt->bindValue(':mel', $mel);
        $stmt->execute();
        $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($livres)) {
            // Confirmer les emprunts-réservations
            foreach ($livres as $livre) {
                // Mettre à jour la table emprunter pour confirmer l'emprunt
                $stmt = $connexion->prepare(
                    "UPDATE emprunter 
                     SET dateemprunt = :dateemprunt, dateretour = :dateretour 
                     WHERE nolivre = :nolivre AND mel = :mel"
                );
                $dateemprunt = date('Y-m-d');
                $dateretour = date('Y-m-d', strtotime('+3 weeks'));
                $stmt->bindValue(':dateemprunt', $dateemprunt);
                $stmt->bindValue(':dateretour', $dateretour);
                $stmt->bindValue(':nolivre', $livre['nolivre']);
                $stmt->bindValue(':mel', $mel);
                $stmt->execute();
            }

            // Redirection vers la page panier
            header("Location: panier.php?confirmed=true");
            exit;
        } else {
            echo "Votre panier est vide.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }
} else {
    echo "Accès non autorisé.";
}
?>