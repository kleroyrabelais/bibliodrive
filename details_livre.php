<?php
require_once('connexion.php')
$stmt = $connexion->prepare("SELECT * FROM livre");
$stmt->setFetchMode(PDO::FETCH_OBJ);
//  les résultats seront retourné en mode 'objet'
$stmt->execute();
//parcours des resultats
while($enregistrement = $stmt->fetch())
{
    //affichage des champs
    echo '<p>', $enregistrement->titre,'</p>';
}
?>