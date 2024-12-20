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


<?php
  $numero = $_GET["numero"]; 

  $stmt = $connexion->prepare("SELECT prenom,nom,l.isbn13,l.detail,l.photo from auteur a inner join livre l on (a.noauteur = l.noauteur) where nolivre = :numero "); 
  $stmt->bindValue(":numero", $numero);
  $stmt->setFetchMode(PDO::FETCH_OBJ);
  $stmt->execute();

while($enregistrement = $stmt->fetch())
{
echo 'Auteur : ' .$enregistrement->prenom. ' ' .$enregistrement->nom.  '<br> ';
echo 'ISBN13 : ' .$enregistrement->isbn13. '<br>';
echo 'Résumé du livre <br> <br>';
echo ' '.$enregistrement->detail. ' ';
}
  ;?>

<?php
 $numero = $_GET["numero"]; 

 $stmt = $connexion->prepare("SELECT photo from livre where nolivre = :numero "); 
 $stmt->bindValue(":numero", $numero);
 $stmt->setFetchMode(PDO::FETCH_OBJ);
 $stmt->execute();

while($enregistrement = $stmt->fetch())
{
    echo '<img src="covers/'.$enregistrement->photo.'" alt="Image livre" width="300" height="500">';
}
?>