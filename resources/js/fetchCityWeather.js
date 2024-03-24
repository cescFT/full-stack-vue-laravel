import { createApp } from 'vue';

/**
 * Aquest js és el que s'inclou a la pantalla on hi ha la informació de la predicció meteorologica de la ciutat, per tant,
 * està inclòs al cityweather.blade.php i el template i la renderització de la informació està implementada a CityWeather.vue
 */

const app = createApp({});

import CityWeather from './components/CityWeather.vue';
app.component('city-weather', CityWeather);

app.mount('#cityWeather');