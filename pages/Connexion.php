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
    <h1>Connexion</h1>
    <p><?php echo $this->feedback; ?></p>
    <form action=<?php echo Router::getIndexPath(); ?> method="post">
      <label>Login : <input type="text" name="login" required /></label>
      <label>Mot de passe : <input type="password" name="password" required /></label>
      <button type="submit">Se connecter</button>
    </form>
  </body>
</html>
