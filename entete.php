<!DOCTYPE html>
<head>
<title>entete</title>
<meta charset="utf-8">
    <!-- charset=UTF-8 : pour que les caractères accentués ressortent correctement -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- la balise ci-dessus indique que l'affichage doit se faire sur la totalité de l'écran, par défaut voir Responsive Design -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"  crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Page d'acceuil (maintenance jusqu'au 6 janvier 2025)</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
      aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="d-flex" action="pagededetail.php" method="GET">
            <input class="form-control me-2" type="text" placeholder="Entrer le nom d'un Auteur" name="Auteur" >
            <button class="btn btn-light"  type="submit">rechercher</button>
        </form>
      </div>
      <a class="btn btn-primary" href="panier.php">panier</a>
    </div>
</nav>
<?php
try {

  $dns = 'mysql:host=localhost;dbname=mabibliodrive'; // dbname : nom de la base
  
  $utilisateur = 'root'; // root sur vos postes
  
  $motDePasse = ''; // pas de mot de passe sur vos postes
  
  $connexion = new PDO( $dns, $utilisateur, $motDePasse );
  
  } catch (Exception $e) {
  
  echo "Connexion à MySQL impossible : ", $e->getMessage();
  
  die();
  
  }

$stmt = $connexion->prepare("SELECT photo FROM livre order by dateajout DESC limit 3");
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

 
echo 
'<div id="demo" class="carousel slide" data-bs-ride="carousel">
  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>

  <!-- The slideshow/carousel -->
  <div class="carousel-inner">';

$x = 0;
while ($enregistement = $stmt->fetch()) {
    if ($x == 0) {
        echo '<div class="carousel-item active">
              <img src="covers/'.$enregistement->photo.'" alt="photo carousel" class="d-block mx-auto" style="width:25%">
              </div>';
        $x += 1; 
    } else {
        echo '<div class="carousel-item">
              <img src="covers/'.$enregistement->photo.'" alt="photo carousel" class="d-block mx-auto" style="width:25%">
              </div>';
    }
}
echo '</div>';  // Fermeture du carousel-inner

echo '
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>';
?>
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</body>