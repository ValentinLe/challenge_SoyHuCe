<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skin/all.css">
    <link rel="stylesheet" href="skin/connexionCreate.css">
    <title>Connexion</title>
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <main>
      <h1>Connexion</h1>
      <p><?php echo $this->feedback; ?></p>
      <form action=<?php echo Router::getIndexPath(); ?> method="post">
        <div class="zoneInput">
          <label>Login <input type="text" name="login" required /></label>
          <label>Mot de passe <input type="password" name="password" required /></label>
        </div>
        <button type="submit">Se connecter</button>
      </form>
    </main>
  </body>
</html>
