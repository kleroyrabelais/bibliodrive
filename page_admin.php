<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Page administrateur</title>

  <meta charset="utf-8">

<!-- charset=UTF-8 : pour que les caractères accentués ressortent correctement -->

  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- la balise ci-dessus indique que l'affichage doit se faire sur la totalité de l'écran, par défaut voir Responsive Design -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    </link>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-9">
        <?php

        ?>
      </div>
      <div class="col-sm-3">
        <?php  
          require_once ('authentification.php')   
        ?>
      </div>
    </div>
  </div>
</body>
</html>