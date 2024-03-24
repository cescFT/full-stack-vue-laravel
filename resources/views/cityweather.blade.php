<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cerca municipi</title>
        @vite('resources/js/fetchCityWeather.js')
        @vite('resources/css/app.css')
    </head>
    <body id="cityWeather">
      <city-weather></weather-component>
    </body>
</html>
