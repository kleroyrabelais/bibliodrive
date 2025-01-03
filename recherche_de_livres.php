<!DOCTYPE html>
<html lang="fr">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>Site Rabelais</title>
    <meta charset="utf-8">
    <!-- charset=UTF-8 : pour que les caractères accentués ressortent correctement -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- la balise ci-dessus indique que l'affichage doit se faire sur la totalité de l'écran, par défaut voir Responsive Design -->
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <?php
                    include ('navbar.php');
                    require_once('connexion.php');
                    
                    // Vérifie si l'auteur est passé dans l'URL
                    if (isset($_GET['auteur'])) {
                        $auteur = $_GET['auteur'];

                        // Préparation de la requête pour récupérer les livres de l'auteur
                        $stmt = $connexion->prepare("SELECT nolivre, titre FROM livre 
                                                      INNER JOIN auteur ON livre.noauteur = auteur.noauteur 
                                                      WHERE auteur.nom = :nom 
                                                      ORDER BY titre");
                        $stmt->bindValue(":nom", $auteur);
                        $stmt->setFetchMode(PDO::FETCH_OBJ);
                        $stmt->execute();

                        echo "<h1>Livres de l'auteur : " . $auteur . "</h1>";

                        // Affiche les résultats sous forme de liens cliquables
                        while ($livre = $stmt->fetch()) {
                            echo "<p><a href='detail_livre.php?nolivre=" . $livre->nolivre . "'>" . $livre->titre . "</a></p>";
                        }
                    } else {
                        echo "<p>Aucun auteur spécifié.</p>";
                    }
                ?>
            </div>
            <div class="col-sm-3">
                <?php  
                    require_once ('authentification.php');
                ?>
                pages d'admin (ajout d'un livre)
            </div>
        </div>
    </div>
</body>
</html>