<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>Panier Bibliodrive</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <?php
                    include ('navbar.php');
                    require_once('connexion.php');

                    if (isset($_SESSION['mel'])) {
                        $mel = $_SESSION['mel'];

                        // Récupérer les livres réservés par l'utilisateur
                        $stmt = $connexion->prepare(
                            "SELECT l.titre, l.isbn13, l.anneeparution, l.detail, l.photo, e.nolivre 
                             FROM emprunter e
                             INNER JOIN livre l ON e.nolivre = l.nolivre
                             WHERE e.mel = :mel"
                        );
                        $stmt->bindValue(':mel', $mel);
                        $stmt->execute();
                        $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }
                ?>
                <h1>Votre Panier</h1>
                <?php if (!empty($livres)): ?>
                    <ul>
                        <?php foreach ($livres as $livre): ?>
                            <li>
                                <h2><?= $livre['titre'] ?></h2>
                                <p><strong>ISBN13:</strong> <?= $livre['isbn13'] ?></p>
                                <p><strong>Année de parution:</strong> <?= $livre['anneeparution'] ?></p>
                                <p><strong>Résumé:</strong> <?= $livre['detail'] ?></p>
                                <?php if (!empty($livre['photo']) && file_exists('covers/' . $livre['photo'])): ?>
                                    <img src="covers/<?= $livre['photo'] ?>" alt="Couverture du livre" width="200">
                                <?php else: ?>
                                    <p>Aucune image de couverture disponible.</p>
                                <?php endif; ?>
                                <form method="post" action="retirer_livre.php">
                                    <input type="hidden" name="nolivre" value="<?= $livre['nolivre'] ?>">
                                    <button type="submit" class="btn btn-danger">Retirer du panier</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Votre panier est vide.</p>
                <?php endif; ?>
            </div>
            <div class="col-sm-3">
                <?php require_once('authentification.php'); ?>
            </div>
        </div>
    </div>
</body>
</html>