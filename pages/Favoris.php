<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skin/all.css">
    <title>Favoris</title>
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <form action='<?php echo Router::getSongPath("") ?>' method="post">
      <section id="results">
        <div class="item">
          <span>Durée</span>
          <span>Nom piste</span>
          <span>Nom(s) artiste(s)</span>
          <span>Extrait</span>
          <span>Page</span>
        </div>
        <div class="listSong"><?php echo $list; ?></div>
      </section>
  </body>
</html>
