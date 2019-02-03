<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="skin/all.css">
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <h1>Accueil</h1>
    <form action=<?php echo Router::getSearchPage(); ?> method="post">
      <input type="text" id="entry" placeholder="Rechercher..." name="search">
      <button type="submit" id="bSearch">Rechercher</button>
    </form>
  </body>
</html>
