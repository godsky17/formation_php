<?php 
require_once __DIR__ . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'OpenWeather.php';
$meteo = new OpenWeather('1784cd918003395e82c37e5a4583f2be');
$meteo->getForecast('Monpellier,fr');

require __DIR__ . DIRECTORY_SEPARATOR . 'header.php';
?>

<pre>
    <?= var_dump($meteo->getForecast('Monpellier,fr')) ?>
</pre>

<?php require __DIR__ . DIRECTORY_SEPARATOR . 'footer.php'; ?>


