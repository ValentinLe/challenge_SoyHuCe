<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $trackName; ?></title>
  </head>
  <body>
    <img src='<?php echo $srcImage; ?>' width="150" height="150" alt="artwork">
    <p>Piste : <?php echo $trackName; ?> </p>
    <p>Artiste(s) : <a href="<?php echo $urlArtist ?>"><?php echo $artistName; ?></a> </p>
    <p>Date : <?php echo $date; ?> </p>
    <p>Durée : <?php echo $duree; ?></p>
    <p>Prix : <?php echo $trackPrice; ?></p>
    <p>Genre : <?php echo $genre; ?></p>
    <p>Album : <?php echo $collectionName; ?></p>
    <p>Prix album : <?php echo $collectionPrice; ?></p>
  </body>
</html>
