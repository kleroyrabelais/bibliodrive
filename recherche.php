<?php
  $auteur = $_GET["auteur"]; 
  $stmt = $connexion->prepare("SELECT titre,anneeparution,nolivre from livre l inner join auteur a on (a.noauteur = l.noauteur )  where nom like :auteur group by anneeparution ; "); 
  $stmt->bindValue(":auteur", $auteur);
  $stmt->setFetchMode(PDO::FETCH_OBJ);
  $stmt->execute();

while($enregistrement = $stmt->fetch())
{

  echo "<h1><a href='http://localhost/bibliodriveaxl/detaillivre.php?numero=".$enregistrement->nolivre."'>",$enregistrement->titre," (", $enregistrement->anneeparution, ")<br> <br> </a> </h1>" ; 
  
}
;?>