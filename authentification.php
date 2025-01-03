<?php
// Démarre la session si ce n'est pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['mel'])) {
    // Si l'utilisateur est déjà connecté, rediriger vers la page d'accueil
    header("Location: pagededetail.php");
    exit;  // Important d'appeler exit après une redirection
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'connexion.php';
    if (isset($_POST['mel']) && isset($_POST['motdepasse'])) {
        $mel = $_POST['mel'];
        $motdepasse = $_POST['motdepasse'];

        // Vérification des informations de connexion
        $stmt = $connexion->prepare("SELECT * FROM utilisateur WHERE mel = :mel AND motdepasse = :motdepasse");
        $stmt->bindValue(":mel", $mel);
        $stmt->bindValue(":motdepasse", $motdepasse);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $enregistrement = $stmt->fetch();
        if ($enregistrement) {
            $_SESSION['mel'] = $mel;
            // Rediriger vers la page d'accueil après connexion réussie
            header("Location: pagededetail.php");
            exit;
        } else {
            echo "<p class='text-danger'>Échec à la connexion.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <!-- image d'entete affichée ici -->
    <img src="image-entete.png" alt="entete" width="450">
    
    <!-- Formulaire de connexion ou message de bienvenue -->
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