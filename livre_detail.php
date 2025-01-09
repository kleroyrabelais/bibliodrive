<?php
require_once 'connexion.php';

if (isset($_GET['isbn13']) && !empty($_GET['isbn13'])) {
    $isbn13 = $_GET['isbn13'];

    // Préparation de la requête pour récupérer les détails du livre
    try {
        $stmt = $connexion->prepare(
            "SELECT l.nolivre, l.titre, l.isbn13, l.anneeparution, l.detail, l.photo 
             FROM livre l 
             WHERE l.isbn13 = :isbn13"
        );
        $stmt->bindValue(':isbn13', $isbn13);
        $stmt->execute();
        $livre = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }

    // Vérifier si le livre est déjà réservé par un autre utilisateur
    try {
        $stmt = $connexion->prepare("SELECT * FROM emprunter WHERE nolivre = :nolivre AND dateretour IS NULL");
        $stmt->bindValue(':nolivre', $livre['nolivre']);
        $stmt->execute();
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Détail du livre</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <?php require_once 'navbar.php'; ?>
            <?php if (!empty($livre)): ?>
                <h1><?= $livre['titre'] ?></h1>
                <p><strong>ISBN13:</strong> <?= $livre['isbn13'] ?></p>
                <p><strong>Année de parution:</strong> <?= $livre['anneeparution'] ?></p>
                <p><strong>Résumé:</strong> <?= $livre['detail'] ?></p>
                <?php if (!empty($livre['photo']) && file_exists('covers/' . $livre['photo'])): ?>
                    <img src="covers/<?= $livre['photo'] ?>" alt="Couverture du livre" width="200">
                <?php else: ?>
                    <p>Aucune image de couverture disponible.</p>
                <?php endif; ?>
                <?php if (isset($_SESSION['mel'])): ?>
                    <?php if ($livre): ?>
                        <p>Ce livre est actuellement indisponible.</p>
                    <?php else: ?>
                        <form method="post" action="reservation_livre.php">
                            <input type="hidden" name="isbn13" value="<?= $livre['isbn13'] ?>">
                            <button type="submit" class="btn btn-primary">Réserver ce livre</button>
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Pour pouvoir réserver ce livre, vous devez vous connecter.</p>
                <?php endif; ?>
            <?php else: ?>
                <p>Détails du livre non trouvés.</p>
            <?php endif; ?>
        </div>
        <div class="col-sm-3">
            <?php require_once 'authentification.php'; ?>
        </div>
    </div>
</div>
</body>
</html>