<?php

if (!isset($_GET['SLivre']));
{
    $stmt = $SLivre->prepare("Select * from livre")
    $stmt->execute();

    while($SLivre = $stmt->fetch())
        echo '<p>', $SLivre->auteur,'',$SLivre->lire,;

}
?>