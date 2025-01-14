<?php
require_once 'connexion.php';

if (isset($_GET["Auteur"]) && !empty($_GET["Auteur"])) {
    $auteur = $_GET["Auteur"];
    
    // Préparation de la requête pour récupérer les livres de l'auteur
    $stmt = $connexion->prepare(
        "SELECT l.titre, l.isbn13, l.anneeparution 
         FROM livre l 
         INNER JOIN auteur a ON l.noauteur = a.noauteur 
         WHERE a.nom = :auteur"
    );
    $stmt->bindValue(':auteur', $auteur);
    $stmt->execute();
    $livres = $stmt->setFetchMode(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Détails des livres</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <?php 
                require_once 'navbar.php'; 
            ?>
            <h1>Détails des livres</h1>
            <?php
                if (!empty($livres)): 
            ?>
            <ul>
                <?php
                    $stmt = $connexion->prepare(
                        "SELECT l.titre, l.isbn13, l.anneeparution 
                         FROM livre l 
                         INNER JOIN auteur a ON l.noauteur = a.noauteur 
                         WHERE a.nom = :auteur"
                    );
                    $stmt->bindValue(':auteur', $auteur);
                    $stmt->execute();
                    while ($livre = $stmt->fetch(PDO::FETCH_ASSOC)): //détails générale des livres
                ?>
                <li>
                    <a 
                        href="livre_detail.php?isbn13=<?= $livre['isbn13'] ?>">
                        <?= $livre['titre'] ?> (<?= $livre['anneeparution'] ?>)
                    </a>
                </li>
                <?php 
                    endwhile; 
                ?>
            </ul>
            <?php 
                else: 
            ?>
            <p>Aucun livre trouvé pour cet auteur.</p>
            <?php 
                endif; 
            ?>
        </div>
        <div class="col-sm-3">
            <?php 
                require_once 'authentification.php'; 
            ?>
        </div>
    </div>
</div>
</body>
</html>