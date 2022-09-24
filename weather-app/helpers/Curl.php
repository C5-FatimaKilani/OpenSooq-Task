<?php


namespace app\helpers;
class Curl
{
    public static function call_api_get($url, $params)
    {
        $curl = curl_init();

        if (!empty($params)) {
            $url = $url . '?' . http_build_query($params);
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        try {
            $response = json_decode($response, TRUE, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $response = null;
        }
        return $response;
    }
}