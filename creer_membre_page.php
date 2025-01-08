<?php
// Démarre la session si ce n'est pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Créer un membre</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <?php require_once 'navbar.php'; ?>
                <form method="post" action="creer_membre_function.php">
                    <div class="form-group">
                        <label for="mel">Email:</label>
                        <input type="email" class="form-control" id="mel" name="mel" required>
                    </div>
                    <div class="form-group">
                        <label for="motdepasse">Mot de passe:</label>
                        <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville:</label>
                        <input type="text" class="form-control" id="ville" name="ville" required>
                    </div>
                    <div class="form-group">
                        <label for="codepostal">Code postal:</label>
                        <input type="text" class="form-control" id="codepostal" name="codepostal" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Créer un membre</button>
                </form>
            </div>
            <div class="col-sm-3">
                <?php require_once 'authentification.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>