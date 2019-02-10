<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="skin/all.css">
    <link rel="stylesheet" href="skin/accueil.css">
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <main>
      <h1>Accueil</h1>
      <div class="searchZone">
        <form action=<?php echo Router::getIndexPath(); ?> method="post">
          <input type="text" id="entry" placeholder="Rechercher..." name="search">
          <button type="submit" id="bSearch">Rechercher</button>
        </form>
    </div>
    <section>
      <h2>Titre</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <h2>Titre</h2>
    </section>
  </main>
  </body>
</html>
