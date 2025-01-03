<?php
// Démarre la session si ce n'est pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['mel']) && isset($_POST['motdepasse'])) {

        require_once 'connexion.php';

        // Récupère les valeurs envoyées via le formulaire
        $mel = $_POST['mel'];
        $motdepasse = $_POST['motdepasse'];

        // Prépare la requête SQL
        $stmt = $connexion->prepare("SELECT * FROM utilisateur WHERE mel = :mel AND motdepasse = :motdepasse");
        $stmt->bindValue(":mel", $mel);
        $stmt->bindValue(":motdepasse", $motdepasse);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $enregistrement = $stmt->fetch();

        // Si un enregistrement est trouvé connecter l'utilisateur
        if ($enregistrement) {
            $_SESSION['mel'] = $mel;  // Sauvegarde l'email dans la session
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<p class='text-danger'>Échec à la connexion.</p>";  // Affiche un message d'erreur si l'utilisateur n'est pas trouvé
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <!-- image d'entete affichée ici, visible en tout temps -->
    <img src="image-entete.png" alt="entete" width="450">

    <!-- Formulaire de connexion et message de bienvenue -->
    <?php
    if (isset($_SESSION['mel'])) {
        echo "<h2>Connexion réussie !</h2>";
        echo "<p>Vous êtes connecté en tant que : <strong>" . $_SESSION['mel'] . "</strong></p>";
        echo '<a href="déconnexion.php" class="btn btn-danger">Déconnexion</a>';
    } else {
        echo '
        <form method="POST">
            <div class="form-group">
                <input type="email" class="form-control" id="exampleInputEmail1" name="mel" aria-describedby="emailHelp" placeholder="Entrez votre identifiant" required>
            </div>
            <br>
            <div class="form-group">
                <input type="password" class="form-control" id="VotreMotDePasse" name="motdepasse" placeholder="Mot de passe" required>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary" name="btnSeConnecter">Se connecter</button>
            </div>
        </form>';
    }
    ?>
</body>
</html>