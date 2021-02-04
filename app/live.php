<?php

$db = new SQLite3('/db/weather.db');

$res = $db->query("SELECT * FROM sensor_values LIMIT 1");

if ( $res->fetchArray(SQLITE3_ASSOC) ) {
  header('HTTP/1.0 200 OK');
} else {
  header('HTTP/1.0 500 Internal Server Error');
}
