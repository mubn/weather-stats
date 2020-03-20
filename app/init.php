<?php

$pass     = "xyz123";
$dbname   = "weather.db";
$password = $_POST["password"];

if (!isset($password) || !($password == $pass)) {
 die('Wrong password');
}

$db = new SQLite3($dbname);

$table_sensors = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='sensors'");

if ($table_sensors->fetchArray()) {
 die('Already initialized');
}

$db->exec("CREATE TABLE
      sensors(
          name TEXT NOT NULL
      )");

$db->exec("CREATE TABLE
      sensor_values(
          sensorid INTEGER NOT NULL,
          temperature REAL,
          pressure REAL,
          humidity REAL
      )");

$db->exec("INSERT INTO
      sensors(
          name
      ) VALUES('basement')");

$db->exec("INSERT INTO
      sensors(
          name
      ) VALUES('garden')");

echo "SUCCESS";
