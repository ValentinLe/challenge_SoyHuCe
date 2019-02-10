<nav>
  <ul id="menuLeft">
    <li><a href=<?php echo Router::getIndexPath(); ?>>Accueil</a></li>
    <li><a href=<?php echo Router::getSearchPath(""); ?>>Rechercher</a></li>
    <?php
      if ($this->isConnected === true) {
        echo "
        <li><a href=" . Router::getFavorisPath() . ">Favoris</a></li>
        <li><a href=" . Router::getGraphPath() . ">Graphique</a></li>";

      }
    ?>
  </ul>
  <ul id="menuRight">
    <?php
      if ($this->isConnected === true) {
        echo "
        <li><span>" . $_SESSION["login"] . " </span></li>
        <li><a href=" . Router::getDeconnexionPath() . ">Déconnexion</a></li>";
      } elseif ($this->isConnected === false) {
        echo "
        <li><a href=" . Router::getCreateUserPath() . ">Créer compte</a></li>
        <li><a href=" . Router::getConnexionPath() . ">Connexion</a></li>";
      }
    ?>
  </ul>
</nav>
