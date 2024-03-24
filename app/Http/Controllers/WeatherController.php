<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB;
use Cache;

class WeatherController extends Controller
{
    /** 
     * Aquesta funció és la que la vista que renderitza la predicció meteorològica recuperi la informació de l'AEMET.
     * He utilitzat una cache llarga de 30 minuts, ja que el valor serà vàlid perquè no estan tot el temps actualitzant la informació
     * 
     * El que fa basicament aquest endpoint és agafar l'id de ciutat i buscar-la per la base de dades, recupera el codi de la ciutat i la api key per a tirar el curl
     * i finalment retorna aquesta informació
     */
    public function getWeatherFromCity($cityId)
    {
        $itemCached = Cache::get($cityId . '-city');
        if (!empty($itemCached)) {
            return response($itemCached, 200);
        }

        $city = DB::table('cities')
            ->where('id', $cityId)
            ->get();
        
        if (empty($city)) {
            return response(json_encode([]), 200);
        }
        
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
            Cache::put($city[0]->id . '-city', $result, 30);
        }
        return response($result, 200);
    }
}
