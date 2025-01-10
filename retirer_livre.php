<?php
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nolivre']) && isset($_SESSION['mel'])) {
    $nolivre = $_POST['nolivre'];
    $mel = $_SESSION['mel'];

    // Supprimer le livre de la table emprunter
    try {
        $stmt = $connexion->prepare(
            "DELETE FROM emprunter 
             WHERE nolivre = :nolivre AND mel = :mel"
        );
        $stmt->bindValue(':nolivre', $nolivre);
        $stmt->bindValue(':mel', $mel);
        $stmt->execute();

        // Redirection vers la page panier
        header("Location: panier.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }
} else {
    echo "Accès non autorisé.";
}
?>