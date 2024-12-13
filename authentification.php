<!DOCTYPE html>

<html>

<body>

<?php

if (!isset($_POST['btnSeConnecter'])) { /* L'entrée btnSeConnecter est vide = le formulaire n'a pas été submit=posté, on affiche le formulaire */

    echo '

<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We';
    echo'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>';

} else

/* L'utilisateur a cliqué sur Se connecter, l'entrée btnSeConnecter <> vide, on traite le formulaire */

{

// On se connecte

    require_once 'connexion.php';

    $mel = $_POST['mel'];

    $motdepasse = $_POST['motdepasse'];

 

    $stmt = $connexion->prepare("SELECT * FROM utilisateur where mel=:mel AND motdepasse=:motdepasse");

 

    $stmt->bindValue(":mel", $mel); // pas de troisième paramètre STR par défaut

    $stmt->bindValue(":motdepasse", $motdepasse); // idem

    $stmt->setFetchMode(PDO::FETCH_OBJ);

// Les résultats retournés par la requête seront traités en 'mode' objet

    $stmt->execute();

    $enregistrement = $stmt->fetch(); // boucle while inutile

    if ($enregistrement) { // si $enregistrement n'est pas vide = on a trouvé quelque chose -> on est connecté

        echo '<h1>Connexion réussie !</h1>';

    } else { // La requête n'a pas retournée de résultat, on a pas trouvé de ligne correspondant au mel et mot de passe

        echo "Echec à la connexion.";

    }

}

?>

</body>

</html>