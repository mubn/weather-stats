<?php

require 'login.php';

$dbname   = "/db/weather.db";

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
          humidity REAL,
          sqltime DATETIME DEFAULT CURRENT_TIMESTAMP
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
