<?php
$host = '127.0.0.1';
$db_name = 'login_db';
$username = 'root';
$password = 'backpacker0220!!';

$mysqli = new mysqli($host, $username, $password, $db_name);

if ($mysqli ->connect_errno) {
    die('Connection failed'. $mysqli->connect_errno);   
}

return $mysqli;

