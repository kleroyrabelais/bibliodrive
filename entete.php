<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Page d'acceuil (maintenance jusqu'au 6 janvier 2025)</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
      aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="recherche" role="search" method="GET">
          <input class="form-control me-2" type="search" placeholder="Rechercher des livres" aria-label="Search" value="">
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
        $stmt = $connexion -> prepare("SELECT photo FROM livre ORDER BY dateajout DESC LIMIT 3 ");
        $stmt ->setFetchMode(PDO::FETCH_OBJ);
        $stmt ->execute();


         echo '<div align="center">';
         echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">

  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner">';
$x = 0; 
  while($enregistrement = $stmt->fetch()){
    if ($x == 0) { 
       echo '<div class="item active">
      <img src="covers/'.$enregistrement->photo.'" alt="Image1" width="100" height="200">
      </div>';
      $x += 1;
    } else { 
        echo '<div class="item">
        <img src="covers/'.$enregistrement->photo.'" alt="Image1" width="100" height="200">
      </div>';
    }
  }

 
  echo '<a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>';
         
      ?>