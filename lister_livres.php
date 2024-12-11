<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Bibliodrive - Recherche</title>
</head>
<body>
    <?php
    if (isset($_GET['recherche']))
    <header>
        <?php
            session_start();

            require("authetificathion.html");

            require("entete.html");

        ?>
    </header>

    <h1 class="big-title">
        <?php

            if(isset($_GET["auteur"])) {
                $auteur = $_GET["auteur"];
                echo "Recherche pour " . $auteur;
            } else {
                echo "Aucun auteur renseigné.";
            } 

        ?>
    </h1>

    <div class="resultat-recherche">

    <?php
            if(isset($auteur)){
                if($auteur === "*"){
                    $stmt = $connexion->prepare("
                        SELECT nolivre,image,anneeparution,resume,titre FROM livre
                        INNER JOIN auteur ON livre.noauteur = auteur.noauteur
                    ");
                } else {
                    $stmt = $connexion->prepare("
                        SELECT nolivre,image,anneeparution,resume,titre FROM livre
                        INNER JOIN auteur ON livre.noauteur = auteur.noauteur
                        WHERE nom LIKE :auteur;
                    ");
                    $stmt->bindValue(":auteur", '%'.$auteur.'%');
                }

                $stmt->setFetchMode(PDO::FETCH_OBJ);
                $stmt->execute();
    
                if($req->rowCount() == 0) {
                    echo "<p>Aucun Résultat.</p>";
    
                } else {
                    $_SESSION["search"] = $auteur;
                    while($livre = $stmt->fetch()) {
                        if(file_exists("images/covers/".$livre->image   )){
                            $cover = $livre->image;
                        } else {
                            $cover = "book-cover-placeholder.png";
                        }
                        echo '
                            <div class="resultat-container" id="livre_'.$livre->nolivre.'">
                                <div class="resultat-cover">
                                    <img src="images/covers/'.$cover.'" alt="placeholder">
                                </div>
                                <div class="resultat-info">
                                    <p class="resultat-title">'.$livre->titre.'</p>
                                    <p class="resultat-parution">Année parution: <b>'.$livre->anneeparution.'</b></p>
                                    <p class="resultat-resume-title">Résumé</p>
                                    <p class="resultat-resume">
                                        '.$livre->resume.'
                                    </p>
                                    <a href="detail?livre='.$livre->nolivre.'" class="resultat-more-button button-general">Voir plus</a>
                                </div>
                            </div>
                        
                        ';
                    }
                }
            }
        ?>

    </div>
</body>
</html>