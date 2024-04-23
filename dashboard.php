<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App-Dashboard</title>
    <link rel="stylesheet" href="weather.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container">
        <h1 class="heading">Dashboard of 7 days</h1>
        <div class="multiple">

            <?php
            include("./Baackend/connect.php");

          
            $query = "SELECT * FROM weather_data WHERE Date >= DATE_SUB(NOW(), INTERVAL 7 DAY) ORDER BY Date  ASC";
            $result = $mysqli->query($query);  ###it's Get weather data for the past 7 days.

        
            if (!$result) {
                echo "Error: " . $mysqli->error;
                exit();    ###Check for SQL errors
            }

            while ($row = $result->fetch_assoc()) {
                $date = date("l, F j", strtotime($row["Date"]));
                $condition = $row["Weather_condition"];
                $urll = "https://openweathermap.org/img/wn/";
                $val = "@4x.png";
                $temperature = round(($row["temp"] - 273.15));
                $wind_speed = $row["wind"];
                $humidity = $row["humidity"];
                $rainfall = round($row["rainfall"] * 0.0394, 2);
                ###It Display's weather data in container.
                ?>
                <div class="weather">
                    <h2 class="cityname">Florence</h2>
                    <p class="count">IT</p>
                    <p class="time">
                        <?php echo $date; ?>
                    </p>
                        <?php echo $condition; ?>
                    </p>
                    <img class="i" id="icon" src="http://openweathermap.org/img/wn/${iconCode}.png" alt="Icon">
                    <p class="season">
                    <h1 class="temperature">
                        <?php echo $temperature; ?> &deg;C<sup></sup>
                    </h1>
                    <p class="humi">
                        Humidity:
                        <?php echo $humidity; ?>%
                    </p>
                    <p class="speed">
                        Wind:
                        <?php echo $wind_speed; ?> m/s
                    </p>
                    <p class="pressure">
                        Rainfall:
                        <?php echo $rainfall; ?> in
                    </p>
                </div>
                <?php
            }

           
            $mysqli->close(); ###Close database connection
            ?>
        </div>

    </div>
</body>
</html>