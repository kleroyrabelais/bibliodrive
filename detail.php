<?php
require_once 'connexion.php';

if (isset($_GET["Auteur"]) && !empty($_GET["Auteur"])) {
    $auteur = $_GET["Auteur"];
    
    // Préparation de la requête pour récupérer les livres de l'auteur
    try {
        $stmt = $connexion->prepare(
            "SELECT l.titre, l.isbn13, l.anneeparution 
             FROM livre l 
             INNER JOIN auteur a ON l.noauteur = a.noauteur 
             WHERE a.nom = :auteur"
        );
        $stmt->bindValue(':auteur', $auteur);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        $stmt->execute();
        $livres = $stmt->setFetchMode(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Détail de l'auteur</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <?php if (!empty($livres)): ?>
                <ul>
                    <?php foreach ($livres as $livre): //détails générale des livres?>
                        <li>
                            <a href="livre_detail.php?isbn13=<?= $livre['isbn13'] ?>">
                                <?= $livre['titre'] ?> (<?= $livre['anneeparution'] ?>)
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun livre trouvé pour cet auteur.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>