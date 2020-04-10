<?php require 'login.php';?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Weather stats</title>
    <link rel="stylesheet" type="text/css" href="static/main.css">
    <script src="static/chart.min.js"></script>
    <script src="static/main.js"></script>
  </head>
  <body>
    <h1>Weather stats</h1>
    <h2>Temperature <span id="temperature_current"></h2>
    <div class="chart-container">
      <canvas id="temperature"></canvas>
    </div>
    <h2>Pressure <span id="pressure_current"></h2>
    <div class="chart-container">
      <canvas id="pressure"></canvas>
    </div>
    <h2>Humidity <span id="humidity_current"></h2>
    <div class="chart-container">
      <canvas id="humidity"></canvas>
    </div>
    <div class="interval-selector">
      <button id="day">1 day</button>
      <button id="month">7 days</button>
      <button id="year">30 days</button>
    </div>
  </body>
</html>
