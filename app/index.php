<?php require 'login.php';?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Weather stats</title>
    <script src="static/chart.min.js"></script>
    <script src="static/charts.js"></script>
  </head>
  <body>
    <div class="chart-container" style="position: relative; height:25vh; width:95vw">
    <canvas id="temperature"></canvas>
    
    <div class="chart-container" style="position: relative; height:25vh; width:95vw">
    <canvas id="pressure"></canvas>

    <div class="chart-container" style="position: relative; height:25vh; width:95vw">
      <canvas id="humidity"></canvas>
    </div>
    <script>
      buildCharts('/data.php', [['temperature','red'], ['pressure', 'blue'], ['humidity', 'green']]);
    </script>
  </body>
</html>
