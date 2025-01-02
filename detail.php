<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
require_once('connexion.php');

if (isset($_GET["Auteur"]) && !empty($_GET["Auteur"])) {
    $auteur = $_GET["Auteur"];
    
    // Préparation de la requête pour récupérer les livres de l'auteur
    $stmt = $connexion->prepare("
        SELECT isbn13, titre, anneeparution, detail, photo, nom, prenom 
        FROM livre 
        INNER JOIN auteur ON livre.noauteur = auteur.noauteur 
        WHERE auteur.nom LIKE :auteur OR auteur.prenom LIKE :auteur
    ");
    $stmt->bindValue(":auteur", "%" . $auteur . "%", PDO::PARAM_STR);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute();
    
    $livres = $stmt->fetchAll();

    if (!$livres) {
        echo "<p>Aucun livre trouvé pour l'auteur '" . $auteur . "'.</p>";
    } else {
        echo "<h1>Livres de " . $auteur . "</h1>";
        foreach ($livres as $livre) {
            echo "<div class='livre'>";
            echo "<h2>" . $livre->titre . " (" . $livre->anneeparution . ")</h2>";
            echo "<p>Auteur : " . $livre->prenom . " " . $livre->nom . "</p>";
            echo "<p>ISBN13 : " . $livre->isbn13 . "</p>";
            echo "<p>" . $livre->detail . "</p>";
            if (!empty($livre->photo)) {
                echo "<img src='./covers/" . $livre->photo . "' alt='Image de couverture' style='max-width:300px;'>";
            }
            echo "<a href='pagedetail.php?nolivre=" . $livre->isbn13 . "' class='btn btn-primary'>Voir les détails</a>";
            echo "</div><hr>";
        }
    }
}    
?>


<div class="row">
<div class="col-sm-8">
<?php

?>
</div>
<div class="col-sm-4">

</div>

<?php
if (isset($enregistrement) && $enregistrement !== null) {
    if (isset($_SESSION["prenom"])) {
        echo '<form method="POST">';
        echo '<input type="submit" name="btn-ajoutpanier" class="btn btn-success btn-lg" value="Ajouter au panier"></input>';
        echo '</form>';
    } else {
        echo '<p class="text-primary">Pour pouvoir réserver ce livre, vous devez posséder un compte et vous identifier !</p>';
    }

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    if (isset($_POST['btn-ajoutpanier'])) {
        array_push($_SESSION['panier'], $enregistrement->titre);
        echo "Livre ajouté à votre panier :)";
    }
} else {
    echo '<p>Aucun livre à ajouter au panier.</p>';
}
?>
</div>
</body>
</html>