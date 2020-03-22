<?php

require 'login.php';

$dbname = "weather.db";

$sensorid    = $_POST["sensorid"];
$temperature = $_POST["temperature"];
$pressure    = $_POST["pressure"];
$humidity    = $_POST["humidity"];

if (!isset($sensorid) || !is_numeric($sensorid)) {
 die('Wrong sensor data');
}

if (!isset($temperature) || !is_numeric($temperature)) {
 die('Wrong temperature data');
}

if (!isset($pressure) || !is_numeric($pressure)) {
 die('Wrong pressure data');
}

if (!isset($humidity) || !is_numeric($humidity)) {
 die('Wrong humidity data');
}

$db = new SQLite3($dbname);

$db->exec("INSERT INTO
  sensor_values(
      sensorid,
      temperature,
      pressure,
      humidity
  ) VALUES($sensorid,$temperature,$pressure,$humidity)");

echo "SUCCESS";
