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
    <div class="chart-container" style="position: relative; height:25vh;">
      <canvas id="temperature"></canvas>
    </div>
    <div class="chart-container" style="position: relative; height:25vh;">
      <canvas id="pressure"></canvas>
    </div>
    <div class="chart-container" style="position: relative; height:25vh;">
      <canvas id="humidity"></canvas>
    </div>
    <div>
      <button id="day">1 day</button>
      <button id="month">30 days</button>
      <button id="year">365 days</button>
    </div>
    <script>
      page();
    </script>
  </body>
</html>
