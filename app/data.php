<?php

require 'login.php';

$fromDate = $_GET["fromDate"];
$toDate   = $_GET["toDate"];
$sensorid = $_GET["sensorid"];

$db = new SQLite3('/db/weather.db');
$i  = 0;
$res;

if (!isset($sensorid) || !is_numeric($sensorid)) {
 die('Wrong sensor data');
}

if (isset($fromDate) && isset($toDate)) {
 $res = $db->query("SELECT * FROM sensor_values WHERE sensorid = $sensorid AND sqltime BETWEEN '$fromDate' AND '$toDate' ORDER BY sqltime");
} else {
 $res = $db->query("SELECT * FROM sensor_values WHERE sensorid = $sensorid ORDER BY sqltime DESC LIMIT 1");
}

while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
 $temperature[$i] = $row['temperature'];
 $pressure[$i]    = $row['pressure'];
 $humidity[$i]    = $row['humidity'];
 $sqltime[$i]     = $row['sqltime'];
 $i++;
}

$ret = array($sqltime, $temperature, $pressure, $humidity);

echo json_encode($ret);
