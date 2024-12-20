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

echo'
        <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
        <div class="carousel-inner">
          <div class="carousel-item active">';
           $x=0;
            while($enregistrement = $stmt->fetch()){
              if ($x ==0) {
                echo'<div class="item active">
                <img src="covers'.$enregistrement->photo.'"alt=image="imagecarousel" width="100" height="200">
                </div>';
                $x += 1;
              }
              else {
                echo '<div class="item">
                <img src="covers"'.$enregistrement->photo.'"alt="imagecarousel" width=100" height="200">
                </div>';
              }
            }
          echo'
            <img src="..." class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>'
         
      ?>