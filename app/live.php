<?php
try {
  $db = new SQLite3('/db/weather.db');
} catch (Exception e) {
  header('HTTP/1.0 500 Internal Server Error');
}
