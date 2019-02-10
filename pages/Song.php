<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skin/all.css">
    <link rel="stylesheet" href="skin/song.css">
    <title><?php echo $trackName; ?></title>
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>

    <main>
      <section class="top">
        <h1><?php echo $trackName; ?></h1>
        <div id="zoneImg">
          <img src='<?php echo $srcImage; ?>' width="200" height="200" alt="artwork">
        </div>
        <div>
          <h2>Informations principales</h2>
          <p>Artiste(s) : <a href="<?php echo $urlArtist ?>"><?php echo $artistName; ?></a> </p>
          <p>Durée : <?php echo $duree; ?></p>
          <p>Date : <?php echo $date; ?> </p>
          <p>Genre : <?php echo $genre; ?></p>
          <p>Prix : <?php echo $trackPrice; ?></p>
        </div>
      </section>
      <section>
        <audio controls src= <?php echo $extraitURL; ?>></audio>
      </section>
      <section class="bot">
        <div>
          <h2>Album</h2>
          <p>Album : <?php echo $collectionName; ?></p>
          <p>Prix album : <?php echo $collectionPrice; ?></p>
        </div>
        <div>
          <h2>Favoris</h2>
          <?php echo $favoris; ?>
        </div>
      </section>
    </main>
  </body>
</html>
