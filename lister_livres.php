<?php
$SLivre = new PDO('mysql:host=localhost;dbname=mabibliodrive', 'auteur', 'livre');

if (!isset($_GET['SLivre'])) {
    $stmt = $SLivre->prepare("SELECT * FROM livre");
    $stmt->execute();

    while ($livre = $stmt->fetch()) {
        echo '<p>', $livre['auteur'], ' ', $livre['lire'], '</p>';
    }
}
?>
