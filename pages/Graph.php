<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Graphique</title>
    <link rel="stylesheet" href="skin/all.css">
    <link rel="stylesheet" href="skin/graph.css">
    <script src="../js/chartjs/Chart.js"></script>
    <script src="../js/chartjs/Chart.min.js"></script>
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
    <script>
      var ctx = document.getElementById("myChart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo $labels ?>,
            datasets: [{
                label: 'Genres musicaux',
                data: <?php echo $values; ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            responsive: true,
            maintainAspectRatio: true,
        }
      });
    </script>
  </body>
</html>
