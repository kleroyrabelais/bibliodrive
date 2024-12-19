<!DOCTYPE html>

<html lang="fr">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="bibliodrive.css">
<head>
  <title>Bibliodrive de Moulinsart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

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
?>
<body>
<div class="container">
  <div class="row">
    <div class="col-sm-9">
      <h4>La bibliothèque de Moulinsart est fermée au public jusqu'à nouvelle ordre. Mais ils vous est possible de réserver et retirer vos livres via notre service Bibliodrive !</h4>
      <br>
      <br>
      <nav class="navbar navbar-dark bg-blue">
        <form action="rechercheauteur.php" method="get">
          <div class="input-group">
            <input type="text" class="form-control" name="auteur" placeholder="Rechercher dans le catalogue ( saisie du nom de l'auteur) ">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit">Recherche</button>
            </div>
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">Panier</button>
            </div>
          </div>
        </form>
      </nav>
    </div>
    <div class="col-sm-3">
      <img src="Chateau.jpg" alt="Chateau" width="300" height="175"> 
    </div>
  </div>
  <div class="row">
    <div class="col-sm-9">
      <h2> Dernières acquisitions 
      <br>
      <br>
      <br>
      <?php
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
      <img src="covers/'.$enregistrement->photo.'" alt="Image1" width="300" height="500">
      </div>';
      $x += 1;
    } else { 
        echo '<div class="item">
        <img src="covers/'.$enregistrement->photo.'" alt="Image1" width="300" height="500">
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

      </h2>
    </div>
    <div class="col-sm-3"><h1>Se connecter</h1>
        <form>
          <label for="id"><h6>Identifiant</h6></label>
          <input class="form-control" id="id" type="text">
          <label for="mdp"><h6>Mot de passe</h6></label>
          <input class="form-control" id="mdp" type="text">
          <br>
          <br>
          <div class="text-center">
          <button class="btn btn-default" type="submit">Connexion</button>
          </div>
        </form>
    </div>
  </div>
</div>
</body>

</html>   