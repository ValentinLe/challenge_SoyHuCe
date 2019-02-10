<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skin/all.css">
    <link rel="stylesheet" href="skin/connexionCreate.css">
    <title>Créer compte</title>
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <main>
      <h1>Création d'un nouveau compte</h1>
      <p><?php echo $this->feedback; ?></p>
      <form action=<?php echo Router::getIndexPath(); ?> method="post">
        <div class="zoneInput">
          <label>Login <input type="text" name="newLogin" required /></label>
          <label>Mot de passe <input type="password" name="newPassword" required /></label>
        </div>
        <button type="submit">Créer le compte</button>
      </form>
    </main>
  </body>
</html>
