<?php

require 'login.php';

$fromDate = $_GET["fromDate"];
$toDate = $_GET["toDate"];

$db = new SQLite3('/db/weather.db');
$res = $db->query("SELECT * FROM sensor_values WHERE sqltime BETWEEN '$fromDate' AND '$toDate'");

$i = 0;

while($row = $res->fetchArray(SQLITE3_ASSOC)){ 
    $temperature[$i] = $row['temperature'];
    $pressure[$i] = $row['pressure'];
    $humidity[$i] = $row['humidity'];
    $sqltime[$i] = $row['sqltime'];
    $i++;
}

$ret = array($sqltime, $temperature, $pressure, $humidity);

echo json_encode($ret);
