<?php

$user     = getenv('APP_USER');
$pass     = getenv('APP_PASS');

function setBasicAuthHeader(){
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
}

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    setBasicAuthHeader();
    die('You need to log in.');
} else if ($_SERVER['PHP_AUTH_USER'] != $user || $_SERVER['PHP_AUTH_PW'] != $pass) {
    setBasicAuthHeader();
    die('Your credentials do not match.');
}
