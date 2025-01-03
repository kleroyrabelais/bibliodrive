<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>détail du livre</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </link>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <?php 
                require_once ('navbar.php');
                require_once ('detail.php'); 
            ?>
        </div>
        <div class="col-sm-3">
            <img src="image-entete.png" alt="entete" width="450">
                <?php 
                    if (isset($_SESSION['mel'])) {
                        echo "<p>Vous êtes connecté en tant que : " . $_SESSION['mel'] . "</p>";
                        echo '<a href="déconnexion.php" class="btn btn-danger">Déconnexion</a>';
                    } else {
                        require_once ('authentification.php');
                    }                
            ?>
        </div>
    </div>
</div>
</body>
</html>