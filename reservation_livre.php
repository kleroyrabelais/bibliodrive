<?php
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['isbn13']) && isset($_SESSION['mel'])) {
    $isbn13 = $_POST['isbn13'];
    $mel = $_SESSION['mel'];

    // Récupérer le numéro du livre
    try {
        $stmt = $connexion->prepare("SELECT nolivre FROM livre WHERE isbn13 = :isbn13");
        $stmt->bindValue(':isbn13', $isbn13);
        $stmt->execute();
        $livre = $stmt->fetch(PDO::FETCH_ASSOC);
        $nolivre = $livre['nolivre'];
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }

    // Vérifier si le livre est déjà réservé par un autre utilisateur
    try {
        $stmt = $connexion->prepare("SELECT * FROM emprunter WHERE nolivre = :nolivre AND dateretour IS NULL");
        $stmt->bindValue(':nolivre', $nolivre);
        $stmt->execute();
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reservation) {
            // Le livre est déjà réservé
            echo "Ce livre est déjà emprunté, veuillez patienter.";
        } else {
            // Insérer la réservation dans la base de données
            $dateemprunt = date('Y-m-d');
            $dateretour = date('Y-m-d', strtotime('+3 weeks')); //3semaines plus tard
                //insérer la réservation dans la base de données
            $stmt = $connexion->prepare( 
                "INSERT INTO emprunter (mel, nolivre, dateemprunt, dateretour) 
                 VALUES (:mel, :nolivre, :dateemprunt, :dateretour)"
            );
            $stmt->bindValue(':mel', $mel);
            $stmt->bindValue(':nolivre', $nolivre);
            $stmt->bindValue(':dateemprunt', $dateemprunt);
            $stmt->bindValue(':dateretour', $dateretour);
            $stmt->execute();

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