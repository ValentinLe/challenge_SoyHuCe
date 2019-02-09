<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skin/all.css">
    <title><?php echo $trackName; ?></title>
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <img src='<?php echo $srcImage; ?>' width="150" height="150" alt="artwork">
    <p>Piste : <?php echo $trackName; ?> </p>
    <p>Artiste(s) : <a href="<?php echo $urlArtist ?>"><?php echo $artistName; ?></a> </p>
    <p>Date : <?php echo $date; ?> </p>
    <p>Durée : <?php echo $duree; ?></p>
    <p>Prix : <?php echo $trackPrice; ?></p>
    <p>Genre : <?php echo $genre; ?></p>
    <p>Album : <?php echo $collectionName; ?></p>
    <p>Prix album : <?php echo $collectionPrice; ?></p>
    <p class="message"><?php echo $this->feedback; ?></p>
    <audio controls src= <?php echo $extraitURL; ?>></audio>
    <?php echo $favoris; ?>
  </body>
</html>
