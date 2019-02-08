<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skin/all.css">
    <link rel="stylesheet" href="skin/search.css">
    <link rel="stylesheet" href="skin/listItem.css">
    <title>Favoris</title>
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <h1>Liste de vos Favoris</h1>
    <form action='<?php echo Router::getSongPath("") ?>' method="post">
      <main id="results">
        <div class="listSong"><?php echo $list; ?></div>
      </main>
  </body>
</html>
