<?php

function curl($url) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

if ($_GET['city']) {

    $urlContents = curl("http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&type=accurate&appid=e4c82fda769143d58be899bf4a5a8262");

    $weatherArray = json_decode($urlContents, true);

    $coordinates = $weatherArray['coord'];

    $weather = "The weather in ".$_GET['city']." is currently ".$weatherArray['weather'][0]['description'].".";

    $tempInFahrenheit = intval($weatherArray['main']['temp'] - 273.15);

    $speedInMPH = intval($weatherArray['wind']['speed']*2.24);

    $weather .=" The temperature is ".$tempInFahrenheit."&deg; with a wind speed of ".$speedInMPH." km/hr" ;

    $latitude = $weatherArray['coord']['lat'];
    $longitude = $weatherArray['coord']['lon'];

    $rise = $weatherArray['sys']['sunrise'];
    $ri = date("H:i:s", $rise);

    $pressure = $weatherArray['main']['pressure'];
    $Humidity = $weatherArray['main']['humidity'];


    $city = $weatherArray['name'];
    $country = $weatherArray['sys']['country'];
    $condition = $weatherArray['weather'][0]['main'];


}
?>
<script type="text/javascript">
    var coord = <?php echo json_encode($coordinates)?>
</script>
<?php

include 'Shared/header.php';
?>

<div class="container">
    <div id="header-panel">
        <a href="weatherapp.php">Bertley Weather and Maps</a>
    </div>
    <div id="content-panel">
        <div id="map-panel">
            <div id="panel-search">
                <form method="get" action="weatherdetails.php">
                    <div class="input-group">
                         <input type="text" class="form-control city" id="city" name="city" aria-describedby="city" placeholder="E.g. New York, Tokyo" value="<?=$_GET['city']?>">
                        <div class="input-group-prepend">
                            <button id="map-button" type="submit"><i class="fas fa-location-arrow"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="map">

            </div>
        </div>
        <div id="result-panel">
            <div id="temp-panel">
                <div id="result-city">
                    <?=$city?>, <?=$country?>
                    <span><?=$condition?></span>
                </div>
                <div id="temp">
                    <?=$tempInFahrenheit?><sup>o</sup>
                    <span id="celcius">Celcius</span>
                </div>
                <div id="result-message" class="px-4">
                    <?= $weather ?>
                </div>
            </div>
            <div class="result-box">
                <div class="result-icon">
                    <i class="fab fa-cloudversify pl-4"></i>
                </div>
                <div class="result-label">
                    Wind
                </div>
                <div class="result-value">
                    <?=$speedInMPH?> KM/H
                </div>
            </div>
            <div class="result-box">
                <div class="result-icon">
                    <i class="fab fa-product-hunt pl-4"></i>
                </div>
                <div class="result-label">
                    Pressure
                </div>
                <div class="result-value">
                    <?=$pressure?> hPa
                </div>
            </div>
            <div class="result-box">
                <div class="result-icon">
                    <i class="fab fa-steam pl-4"></i>
                </div>
                <div class="result-label">
                    Humidity
                </div>
                <div class="result-value">
                    <?=$Humidity?> %
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAq7NLVaCTtY5WjvyoLdNjgnicjuGxaESE&callback=initializeMap"
            async defer></script>
<?php
include 'Shared/footer.php';
?>