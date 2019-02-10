<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skin/all.css">
    <title>Créer compte</title>
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <main>
      <h1>Création d'un nouveau compte</h1>
      <form action=<?php echo Router::getIndexPath(); ?> method="post">
        <label>Login : <input type="text" name="newLogin" required /></label>
        <label>Mot de passe : <input type="password" name="newPassword" required /></label>
        <button type="submit">Créer le compte</button>
      </form>
    </main>
  </body>
</html>
