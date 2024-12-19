<!DOCTYPE html>
<html>
<body>
<img src="image-entete.png" alt=entete width=450>
<?php

if (!isset($_POST['btnSeConnecter'])) { 
    echo '
    <form method="POST">
        <div class="form-group">
            <input type="email" class="form-control" id="exampleInputEmail1" name="mel" aria-describedby="emailHelp" placeholder="Enterer votre identifiant" required>
        </div>
        <br>
        <div class="form-group">
            <input type="Votre mot de passe" class="form-control" id="Votre mot de passe" name="motdepasse" placeholder="Password" required>
        </div>
        <br>
        <div>
        <button type="submit" class="btn btn-primary" name="btnSeConnecter">Submit</button>
        </div>
    </form>';
} else {
    require_once 'connexion.php';
    if (isset($_POST['mel']) && isset($_POST['motdepasse'])) {
        $mel = $_POST['mel'];
        $motdepasse = $_POST['motdepasse'];

        $stmt = $connexion->prepare("SELECT * FROM utilisateur WHERE mel = :mel AND motdepasse = :motdepasse");
        $stmt->bindValue(":mel", $mel); 
        $stmt->bindValue(":motdepasse", $motdepasse);    
        $stmt->setFetchMode(PDO::FETCH_OBJ);  
        $stmt->execute();
        $enregistrement = $stmt->fetch();
        if ($enregistrement) {
            echo '<h1>Connexion réussie !</h1>';
        } else {
            echo "Echec à la connexion.";
        }
    } else {
        echo "Echec à la connexion.";
    }
}

?>

</body>
</html>
