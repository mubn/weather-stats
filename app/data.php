<?php

$db = new SQLite3('weather.db');

$res = $db->query('SELECT * FROM sensor_values');

$i = 0;

while($row = $res->fetchArray(SQLITE3_ASSOC)){ 
    $temperature[$i] = $row['temperature'];
    $pressure[$i] = $row['pressure'];
    $humidity[$i] = $row['humidity'];
    $i++;
}

$ret = array($temperature, $pressure, $humidity);

echo json_encode($ret);
