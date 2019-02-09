<nav>
  <a href=<?php echo Router::getIndexPath(); ?>>Accueil</a>
  <a href=<?php echo Router::getSearchPath(""); ?>>Rechercher</a>
  <?php
    if ($this->isConnected === true) {
      echo "
      <a href=" . Router::getFavorisPath() . ">Favoris</a>
      <a href=" . Router::getGraphPath() . ">Graphique</a>
      <span style='margin-left: 20%;'>" . $_SESSION["login"] . " </span>
      <a href=" . Router::getDeconnexionPath() . ">Déconnexion</a>";

    } elseif ($this->isConnected === false) {
      echo "
      <a href=" . Router::getCreateUserPath() . ">Créer compte</a>
      <a href=" . Router::getConnexionPath() . ">Connexion</a>";
    }
  ?>
</nav>
