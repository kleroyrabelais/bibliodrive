<?php
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['isbn13']) && isset($_SESSION['mel'])) {
    $isbn13 = $_POST['isbn13'];
    $mel = $_SESSION['mel'];

    // Récupérer le numéro du livre
    try {
        $stmt = $connexion->prepare("SELECT nolivre, titre, isbn13, anneeparution, detail, photo FROM livre WHERE isbn13 = :isbn13");
        $stmt->bindValue(':isbn13', $isbn13);
        $stmt->execute();
        $livre = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }

    // Vérifier si le livre est déjà réservé par un autre utilisateur
    try {
        $stmt = $connexion->prepare("SELECT * FROM emprunter WHERE nolivre = :nolivre AND dateretour IS NULL");
        $stmt->bindValue(':nolivre', $livre['nolivre']);
        $stmt->execute();
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reservation) {
            // Le livre est déjà réservé
            echo "Ce livre est déjà emprunté, veuillez patienter.";
        } else {
            // Stocker les informations du livre dans la session
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = [];
            }
            $_SESSION['panier'][] = $livre;

            // Redirection vers la page panier
            header("Location: panier.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }
} else {
    echo "Accès non autorisé.";
}
?>