<?php
require_once 'connexion.php';

if (isset($_GET["isbn13"]) && !empty($_GET["isbn13"])) {
    $isbn13 = $_GET["isbn13"];
    
    // Préparation de la requête pour récupérer les détails du livre
    $stmt = $connexion->prepare("
        SELECT isbn13, titre, anneeparution, detail, photo 
        FROM livre 
        WHERE isbn13 = ?
    ");
    $stmt->execute([$isbn13]);
    $livre = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Détail du livre</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <?php if (!empty($livre)): ?>
                <h1><?= $livre['titre'] ?></h1>
                <p><strong>ISBN13:</strong> <?= $livre['isbn13'] ?></p>
                <p><strong>Année de parution:</strong> <?= $livre['anneeparution'] ?></p>
                <p><strong>Résumé:</strong> <?= $livre['detail'] ?></p>
                <?php if (!empty($livre['photo'])): ?>
                    <img src="<?= $livre['photo'] ?>" alt="Couverture du livre">
                <?php endif; ?>
                <?php if ($connexion): ?>
                    <button class="btn btn-primary">Réserver ce livre</button>
                <?php endif; ?>
            <?php else: ?>
                <p>Détails du livre non trouvés.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>