<?php
namespace App;

use \DateTime;
/**
 * @author Yelohin GAUTHE <gautheyelohin@gmail.com>
 * Classe pour recuperer la meteo.
 */
class OpenWeather
{
    private $apikey;

    public function __construct(string $apikey)
    {
        $this->apikey = $apikey;
    }

    public function getForecast(string $city): ?array
    {
        $curl = curl_init("api.openweathermap.org/data/2.5/forecast/daily?id={$city}&cnt=16&appid={$this->apikey}");
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true, // force curl a conserver les donnees dans une variable
            CURLOPT_CAINFO => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'USERTrust RSA Certification Authority.crt', //certificat ssl
            CURLOPT_TIMEOUT => 1 // temps d'attentes
        ]);
        $data = curl_exec($curl);
        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            return null;
        }
        $results = [];
        $data = json_decode($data, true);
        foreach ($data['list'] as $day) {
            $results[] = [
                'temp' => $day['temp']['day'],
                'description' => $day['weather'][0]['description'],
                'date' => new DateTime('@' . $day['dt'])
            ];
        }
        return $results;
    }
}

