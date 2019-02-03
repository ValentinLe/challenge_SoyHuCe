<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Recherche</title>
    <link rel="stylesheet" href="skin/all.css">
    <link rel="stylesheet" href="skin/search.css">
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <div class="searchZone">
      <form action=<?php echo Router::getSearchPage(); ?> method="post">
        <input type="text" id="entry" placeholder="Rechercher..." name="search" value='<?php echo str_replace("+", " ", $strSearch); ?>'>
        <button type="submit" id="bSearch">Rechercher</button>
      </form>
      <p id="message"></p>
    </div>
    <form action='<?php echo Router::getSongPath() ?>' method="post">
      <section id="results">
        <div class="item">
          <span>Durée</span>
          <span>Nom piste</span>
          <span>Nom(s) artiste(s)</span>
          <span>Extrait</span>
          <span>Page</span>
        </div>
        <div class="listSong"><?php echo $listResults; ?></div>
      </section>
    </form>
  </body>
</html>
