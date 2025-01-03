<?php
session_start();
if (!isset($_SESSION['mel'])) {
    echo '<p class="text-primary">Pour pouvoir réserver, vous devez posséder un compte et vous identifier.</p>';
    exit; //Arréte l'éxécution si l'utilisateur ne s'est pas connecté
}
?>
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
?>
<div class="row">
    <div class="col-sm-9">
        <?php
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

                    // Affichage du bouton réserver
                    if (isset($_SESSION["mel"])) {
                        echo '<form method="POST" action="">';
                        echo '<input type="hidden" name="isbn13" value="' . $livre->isbn13 . '">';
                        echo '<button type="submit" name="btn-reserver" class="btn btn-primary">Réserver le livre</button>';
                        echo '</form>';
}                   else {
                        echo '<p class="text-primary">Pour pouvoir réserver vous devez posséder un compte et vous identifier.</p>';
}

                }
            }
        }
        // Traitement du bouton Réserver
        if (isset($_POST['btn-reserver'])) {
            $isbn13 = $_POST['isbn13'];
        
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = array();
            }
        
            if (!in_array($isbn13, $_SESSION['panier'])) {
                $_SESSION['panier'][] = $isbn13;
                echo '<p class="alert alert-success">Le livre avec ISBN13 ' . $isbn13 . ' a été réservé avec succès !</p>';
            } else {
                echo '<p class="alert alert-warning">Ce livre est déjà dans votre panier.</p>';
            }
        }
        ?>
    </div>
    <div class="col-sm-3">
    </div>
</div>
</body>
</html>
