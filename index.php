<!DOCTYPE html>
<html lang="fr">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Site Rabelais</title>
  <meta charset="utf-8">
<!-- charset=UTF-8 : pour que les caractères accentués ressortent correctement -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- la balise ci-dessus indique que l'affichage doit se faire sur la totalité de l'écran, par défaut voir Responsive Design -->
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-9">
            <?php
            include ('entete.php');
            ?>
			</div>
			<div class="col-sm-3">
					<img src="image-entete.png" alt=entete width=450>
                    <br>
                    <br>
                    <?php
                    
                        include ('authentification.php')
                     ?>
			</div>
		    <div class="row">
		        <div class="col-sm-9">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="./images-couvertures/covers/1984.jpg" class="d-block w-25" alt="1984">
                            </div>
                            <div class="carousel-item">
                                <img src="./images-couvertures/covers/Emma.jpg" class="d-block w-25" alt="Emma">
                            </div>
                            <div class="carousel-item">
                                <img src="./images-couvertures/covers/hamlet.jpg" class="d-block w-25" alt="hamlet">
                            </div>
                        </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    </div>
					carroussel / résultat de la recherche / pages d'admin (ajout d'un livre)
			    </div>
					formulaire de connexion / profil connecté (include)
			    </div>
		    </div>
	    </div>
	</body>
</html>