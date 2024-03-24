<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB;
use Cache;

class WeatherController extends Controller
{
    public function getWeatherFromCity($cityId)
    {
        $itemCached = Cache::get($cityId . '-city');
        if ($itemCached) {
            error_log('loaded from cache');
            return response($itemCached, 200);
        }

        $city = DB::table('cities')
            ->where('id', $cityId)
            ->get();
        
        
        $cityCode = $city[0]->city_code;
        
        $apiKey = env('AEMET_API_KEY');
        $client = new Client();

        $endpoint = "https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/diaria/$cityCode";

        $response = $client->request(
            'GET',
            $endpoint,
             ['headers' => ['api_key' => $apiKey]]
        );

        $statusCode = $response->getStatusCode();

        $urlToGetData = "";
        if ($statusCode == 200) {
            $urlToGetData = json_decode($response->getBody()->getContents(), true)['datos'];
        }

        if (empty($urlToGetData)) {
            throw new \Exception('There are no data in response');
        }

        $responseOfWeather = $client->request('GET', $urlToGetData);
        $statusCode = $responseOfWeather->getStatusCode();

        if ($statusCode !== 200) {
            $result = json_encode([]);
        } else {
            $result = $responseOfWeather->getBody()->getContents();
            Cache::put($city[0]->id . '-city', $result, 120);
        }
        error_log('loaded from api');
        return response($result, 200);
    }
}
