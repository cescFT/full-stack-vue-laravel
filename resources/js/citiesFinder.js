import './bootstrap';
import { createApp } from 'vue';

/**
 * En aquest JS hi ha tots els components que es renderitzen al blade index.blade.php
 * El WeatherComponent està implementat a CitiesFromFinder.vue -> aqui hi ha la funcionalitat de buscar i que quan apretin el botó, que es tiri l'ajax
 * al controlador CityController::findCityByName
 */
const app = createApp({});

import WeatherComponent from './components/CitiesFormFinder.vue';
app.component('weather-component', WeatherComponent);

/** I tot això ho deix muntat sota el div amb id citiesfinder */
app.mount('#citiesfinder');
