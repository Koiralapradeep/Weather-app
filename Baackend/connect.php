<?php


$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "weather_app_isa";
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name); ###it's set's up database connection

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();###Check for database connection errors
}
?>
