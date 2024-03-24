import { createApp } from 'vue';

const app = createApp({});

import CityWeather from './components/CityWeather.vue';
app.component('city-weather', CityWeather);

app.mount('#cityWeather');