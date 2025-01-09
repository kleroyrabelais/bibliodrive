<?php
// Démarre la session si ce n'est pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include 'connexion.php';

// Récupérer les auteurs depuis la base de données
try {
    $stmt = $connexion->prepare("SELECT noauteur, prenom, nom FROM auteur");
    $stmt->execute();
    $auteurs = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <?php require_once 'navbar.php';
                    require_once 'ajouter_livre_form.php' ?>
            </div>
            <div class="col-sm-3">
                <?php require_once 'authentification.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>