<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Weather stats</title>
    <script src="static/chart.min.js"></script>
    <script src="static/charts.js"></script>
  </head>
  <body>
    <canvas id="temperature" width="400" height="400"></canvas>
    <canvas id="pressure" width="400" height="400"></canvas>
    <canvas id="humidity" width="400" height="400"></canvas>
    <script>
      buildCharts('/data.php', ['temperature', 'pressure', 'humidity']);
    </script>
  </body>
</html>
