<?php

namespace  app\services\weather;

use app\helpers\Value;

class WeatherService
{
    private $weather_gateway;
    private const kelvin_param = 273.15;

    /**
     * @param $weather_gateway
     */

    public function  __construct()
    {
        $this->weather_gateway = new WeatherGateway();
    }

    public function getCityWeather($city)
    {
        $geo_result = $this->getCoordinates($city);
        if($geo_result){
            return $this->getWeather($geo_result["lat"], $geo_result["long"]);

        }
        return  false;
    }

    private function getCoordinates($city)
    {
        $response = $this->weather_gateway->callGeoApi($city);
        $result = false;

        if(isset($response) && !empty($response) && isset($response[0]) && !empty($response[0]))
        {
            $response = $response[0];

            if(Value::not_empty($response, "lat") && Value::not_empty($response, "lon")){
                $result = [
                    "lat"=> $response["lat"],
                    "long"=> $response["lon"]
                ];
            }
        }
        return $result;
    }

    private function getWeather($lat, $long)
    {
        $response = $this->weather_gateway->callWeatherApi($lat, $long);

        $result = false;

        if(isset($response) && !empty($response)){
            if(Value::not_empty($response, "main")){
                $main = $response["main"];
                if(isset($main["temp"]) && isset($main["pressure"]) && isset($main["humidity"])){
                    $result = [
                        "temperature"=> $main["temp"] - self::kelvin_param,
                        "pressure"=> $main["pressure"],
                        "humidity"=> $main["humidity"]
                    ];
                }
            }
        }
        return $result;
    }
}

