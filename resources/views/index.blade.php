<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cerca municipi</title>
        @vite('resources/js/citiesFinder.js')
        @vite('resources/css/app.css')
    </head>
    <body id="citiesfinder">
      <h1 class="text-3xl font-bold underline text-center">
        Predicció meteorològica
      </h1>
      <weather-component></weather-component>
    </body>
</html>
