<?php
include 'connexion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un auteur</title>
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
                    require_once 'ajouter_auteur_form.php' ?>
            </div>
            <div class="col-sm-3">
                <?php require_once 'authentification.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>