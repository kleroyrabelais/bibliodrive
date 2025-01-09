<?php
session_start();
session_destroy(); // Détruit les données de session
header("Location: index.php"); // Redirige vers la page index.php
exit;
?>