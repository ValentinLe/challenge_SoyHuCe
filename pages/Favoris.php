<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skin/all.css">
    <link rel="stylesheet" href="skin/search.css">
    <link rel="stylesheet" href="skin/listItem.css">
    <link rel="stylesheet" href="skin/favoris.css">
    <title>Favoris</title>
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <main>
      <h1>Liste de vos Favoris</h1>
      <form action='<?php echo Router::getSongPath("") ?>' method="post">
        <div id="results">
          <div class="listSong"><?php echo $list; ?></div>
        </div>
      </form>
    </main>
  </body>
</html>
