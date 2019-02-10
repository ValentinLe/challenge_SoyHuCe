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
          <table>
            <tr>
              <td>Artiste(s)</td>
              <td><a href="<?php echo $urlArtist ?>"><?php echo $artistName; ?></a></td>
            </tr>
            <tr>
              <td>Durée</td>
              <td><?php echo $duree; ?></td>
            </tr>
            <tr>
              <td>Date</td>
              <td><?php echo $date; ?></td>
            </tr>
            <tr>
              <td>Genre</td>
              <td><?php echo $genre; ?></td>
            </tr>
            <tr>
              <td>Prix</td>
              <td class="prix"><?php echo $trackPrice; ?></td>
            </tr>
          </table>
        </div>
      </section>
      <section>
        <audio controls src= <?php echo $extraitURL; ?>></audio>
      </section>
      <section class="bot">
        <div>
          <h2>Album</h2>
          <table>
            <tr>
              <td>Album</td>
              <td><a href=<?php echo $collectionUrl; ?>> <?php echo $collectionName; ?></a></td>
            </tr>
            <tr>
              <td>Prix</td>
              <td class="prix"><?php echo $collectionPrice; ?></td>
            </tr>
          </table>
        </div>
        <div>
          <h2>Favoris</h2>
          <?php echo $favoris; ?>
        </div>
      </section>
    </main>
  </body>
</html>
