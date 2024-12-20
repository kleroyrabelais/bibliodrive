<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <?php
                include_once('navbar.php');
            ?>
        </div>
        <div class="col-sm-3">
            <?php 
                include('connexion.php');
                include('authentification.php');
            ?>
        </div>
    </div>
</div>
<?php
echo "Auteur : ".$enregistrement->prenom." ", $enregistrement->nom;
echo "<BR>";
echo "<BR>";
echo "ISBN13 : ".$enregistrement->isbn13;
echo "<BR>";
echo "Résumé du livre";
echo "<BR>";
echo "<BR>";
echo $enregistrement->detail;
echo "<BR>";
if ($enregistrement->dateretour == NULL) {
    echo "Disponible";
} else {
    echo "Non disponible";
}
?>