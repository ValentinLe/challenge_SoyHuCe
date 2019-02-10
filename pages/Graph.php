<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Graphique</title>
    <link rel="stylesheet" href="skin/all.css">
    <link rel="stylesheet" href="skin/graph.css">
    <script src="../js/chartjs/Chart.js"></script>
    <script src="../js/chartjs/Chart.min.js"></script>
    <script>
      let labels = <?php echo $labels; ?>;
      let values = <?php echo $values; ?>;
    </script>
    <script src="../js/graph.js"></script>
  </head>
  <body>
    <header>
      <?php include("parts/nav.php"); ?>
    </header>
    <main>
      <h1>Statistiques de vos favoris</h1>
      <div class="graph">
        <canvas id="myChart" height="100%"></canvas>
      </div>
    </main>
  </body>
</html>
