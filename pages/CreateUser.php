<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skin/all.css">
    <title>Connexion</title>
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <h1>Création d'un nouveau compte</h1>
    <form action=<?php echo Router::getIndexPath(); ?> method="post">
      <label>Login : <input type="text" name="login" required /></label>
      <label>Mot de passe : <input type="password" name="password" required /></label>
      <button type="submit">Créer le compte</button>
    </form>
  </body>
</html>