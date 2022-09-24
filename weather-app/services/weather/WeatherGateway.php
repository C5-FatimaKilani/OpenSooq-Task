<?php
namespace  app\services\weather;

use app\helpers\Curl;

class WeatherGateway
{
    private $base_url = "http://api.openweathermap.org";
    private $geo_path = "/geo/1.0/direct";
    private $weather_path = "/data/2.5/weather";
    private $app_id = "25832d8b92b3b6bf4ac48f4dd8adfbb7";

    public function callGeoApi($city)
    {
        $params = [
            "appid" => $this->app_id,
            "limit" => 1,
            "q" => $city
        ];

        $url = $this->base_url . $this->geo_path;
        return Curl::call_api_get($url, $params);

    }

    public function callWeatherApi($lat, $long)
    {
        $params = [
            "appid" => $this->app_id,
            "lat" => $lat,
            "lon" => $long
        ];

        $url = $this->base_url . $this->weather_path;
        return Curl::call_api_get($url, $params);
    }
}