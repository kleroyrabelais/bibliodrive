<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <?php include_once('navbar.php'); ?>
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
// Vérification de l'existence du paramètre 'numero'
if (!isset($_GET["numero"]) || empty($_GET["numero"])) {
    echo "<p>Paramètre 'numero' manquant dans l'URL.</p>";
    exit();
}

$numero = $_GET["numero"]; // Récupération du numéro depuis l'URL

// Préparation de la requête pour récupérer toutes les informations nécessaires
$stmt = $connexion->prepare("
    SELECT a.prenom, a.nom, l.isbn13, l.detail, l.photo, l.dateretour
    FROM auteur a
    INNER JOIN livre l ON a.noauteur = l.noauteur
    WHERE l.nolivre = :numero
");
$stmt->bindValue(":numero", $numero);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

$enregistrement = $stmt->fetch();

if (!$enregistrement) {
    echo "<p>Aucun livre trouvé pour le numéro donné.</p>";
    exit();
}

// Affichage des détails du livre
echo "Auteur : " . $enregistrement->prenom . " " . $enregistrement->nom . "<br><br>";
echo "ISBN13 : " . $enregistrement->isbn13 . "<br><br>";
echo "Résumé du livre :<br><br>" . $enregistrement->detail . "<br><br>";

// Vérification de la disponibilité
if ($enregistrement->dateretour == NULL) {
    echo "Disponible<br>";
} else {
    echo "Non disponible<br>";
}

// Affichage de l'image de couverture
if (!empty($enregistrement->photo)) {
    echo '<img src="covers/' . $enregistrement->photo . '" alt="Image livre" width="300" height="500">';
} else {
    echo "<p>Aucune image de couverture disponible.</p>";
}
?>
