<?php
include("./connect.php");


$url = "https://api.openweathermap.org/data/2.5/weather?q=Florence&appid=3d5bd33ba5b064887a6caeb6725df952";
try {
    $json_data = file_get_contents($url);
    $weather_data = json_decode($json_data, true);###It Get's weather data from API
} catch (Exception $e) {
    echo "Error fetching weather data: " . $e->getMessage();
    exit();
}


$date_val = date("Y-m-d");
$condition = $weather_data["weather"][0]["description"];
$temperature = $weather_data["main"]["temp"];
$wind_speed = $weather_data["wind"]["speed"];
$humidity = $weather_data["main"]["humidity"]; 
if (isset($weather_data["rain"]["1h"])) {
    $rainfall = $weather_data["rain"]["1h"];##Extract required weather data
} else {
    $rainfall = 0;
}


$delete_query = "DELETE FROM weather_data WHERE date < DATE_SUB(NOW(), INTERVAL 8 DAY)";
$mysqli->query($delete_query);##it Delete data older than 7 days

$insert_query  = "INSERT INTO weather_data (Date, Weather_condition, temp, wind, humidity, rainfall) VALUES ('$date_val', '$condition', '$temperature', '$wind_speed', '$humidity', '$rainfall')";
if ($mysqli->query($insert_query) === TRUE) {
    echo "Weather data inserted successfully"; 
} else {
    echo "Error: " . $mysqli->error;
}
$mysqli->query($insert_query);##it insert's weather data into database



$mysqli->close();###Close database connection
?>