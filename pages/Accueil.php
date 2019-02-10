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
      <h2>Objectifs</h2>
      <p>
        L'objectif de ce projet étant d'intéroger une API et d'utiliser les résultats
        afin de les afficher dans un tableau. Il fallait également
        mettre en place un formulaire afin de pouvoir stocker, dans un fichier ou
        une base de données, le contenu du résultats. Et enfin, interroger une base de
        données ou l'API pour faire un tableau ou un graphique sur les données récoltées.
      </p>
      <h2>Ce qui a été fait</h2>
      <p>
        L'utilisateur peut rechercher des musiques ce qui interrogera l'API de Itunes
        et aura une liste de la réponse. Il peut également se connecter ou créer un
        compte si il n'en a pas. L'avantage d'avoir un compte est qu'il peut ajouter
        le nombre dont il souhaite de musique en favoris et constater dans la rubrique
        <i>Graphique</i> les statistiques sur les genres musicaux qu'il à
        mis en favoris. Les utilisateurs et les favoris par utilisateur sont stockés
        dans une base de données.
      </p>
      <h2>Source</h2>
      <ul>
        <li>API de Itunes : <a href="https://affiliate.itunes.apple.com/resources/documentation/itunes-store-web-service-search-api/" target="_blank">Itunes Search API</a></li>
        <li>Framework pour le graphique : <a href="https://www.chartjs.org/" target="_blank">Chart.js</a> </li>
      </ul>
    </section>
  </main>
  </body>
</html>
