<script setup>
import axios from "axios"
import { ref, onMounted } from 'vue'

const cityWeather = ref([])
const getWeather = () => {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const cityId = urlParams.get('cityId');
    axios.get('/fetchWeather/'+ cityId)
    .then(res => {
            let infoToPrint = {}
            const rawWeather = res.data[0];

            const prediction = rawWeather['prediccion']['dia'];
            let predictionPerDay = [];

            for(let i=0; i < prediction.length; i++) {
                let dayData = prediction[i];
                let infoToPrint = {}
                let dataPerDayIndexedByDay = {}
                const rainProb = dayData['probPrecipitacion'];
                const cotaNieveProv = dayData['cotaNieveProv'];
                const estadoCielo = dayData['estadoCielo'];
                const viento = dayData['viento'];
                const temperatura = dayData['temperatura'];
                const sensacionTermica = dayData['sensTermica'];
                const humedadRelativa = dayData['humedadRelativa'];
                const uvMax = dayData['uvMax'];
                const day = dayData['fecha'].split("T")[0];

                infoToPrint['probPrecipitacion'] = rainProb;
                infoToPrint['cotaNieveProv'] = cotaNieveProv;
                infoToPrint['estadoCielo'] = estadoCielo;
                infoToPrint['viento'] = viento;
                infoToPrint['temperatura'] = temperatura;
                infoToPrint['sensTermica'] = sensacionTermica;
                infoToPrint['uvMax'] = uvMax;
                infoToPrint['day'] = day;
                predictionPerDay.push(infoToPrint);
            }

            infoToPrint['name'] = rawWeather.nombre;
            infoToPrint['province'] = rawWeather.provincia;
            infoToPrint['prediction'] = predictionPerDay;
            infoToPrint['origen'] = rawWeather.origen;
            cityWeather.value = infoToPrint
        })
    .catch(
        error => {
            alert('S\'ha produit un error al intentar recuperar la informació.')
            console.log(error)
        }
    )
}


onMounted(() => getWeather())

</script>

<template>
    <div class="p-3" v-if="Object.keys(cityWeather).length > 0">
        <div class="text-3xl font-bold underline text-center">
            <h1>{{ cityWeather['origen']['productor'] }}</h1>
        </div>
        <div class="text-2xl font-bold">
            Ciutat: {{ cityWeather['name'] }} ({{ cityWeather['province'] }})
        </div>
        
            <div class="flex overflow-x-auto" v-for="valuePrediction, key in cityWeather['prediction']" :key="key">
                <div class="m-5" v-for="predition, key1 in valuePrediction" :key="key1">
                    <div v-if="key1 == 'day'">
                        <ul class="list-disc list-inside m-2">
                            <li>Dia {{ predition }}</li>
                        </ul>
                    </div>
                    <div v-else-if="key1 == 'probPrecipitacion'">
                        <div class="text-lg text-center">Probabilitat de pluja</div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <th scope="col" class="px-6 py-3">Periode</th>
                                    <th scope="col" class="px-6 py-3">Valor</th>
                                </thead>
                                <tbody v-for="rainPrediction, keyrain in predition" :key="keyrain">
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" v-if="'' != rainPrediction['periodo']">{{rainPrediction['periodo']}}</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" v-else="'' == rainPrediction['periodo']">-</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ rainPrediction['value'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <div v-else-if="key1 == 'cotaNieveProv'">
                        <div class="text-lg text-center">Cota de neu</div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <th scope="col" class="px-6 py-3">Periode</th>
                                    <th scope="col" class="px-6 py-3">Valor</th>
                                </thead>
                                <tbody v-for="snowPrediction, keyrain in predition" :key="keyrain">
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{snowPrediction['periodo']}}</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" v-if="'' == snowPrediction['value']">Sense dades</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" v-else-if="'' != snowPrediction['value']">{{ snowPrediction['value'] }}</td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                    <div v-else-if="key1 == 'estadoCielo'">
                        <div class="text-lg text-center">Estat del cel</div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <th scope="col" class="px-6 py-3">Periode</th>
                                    <th scope="col" class="px-6 py-3">Valor</th>
                                </thead>
                                <tbody v-for="skyState, keyrain in predition" :key="keyrain">
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{skyState['periodo']}}</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" v-if="'' == skyState['value']">Sense dades</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" v-else-if="'' != skyState['value']">{{ skyState['value'] }} - {{ skyState['descripcion'] }}</td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                    <div v-else-if="key1 == 'viento'">
                        <div class="text-lg text-center">Vent</div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <th scope="col" class="px-6 py-3">Direcció</th>
                                    <th scope="col" class="px-6 py-3">Velocidat</th>
                                    <th scope="col" class="px-6 py-3">Periode</th>
                                </thead>
                                <tbody v-for="windData, keyrain in predition" :key="keyrain">
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" v-if="'' != windData['direccion']">{{windData['direccion']}}</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" v-else="'' == windData['direccion']">Sense dades</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{windData['velocidad']}}</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ windData['periodo'] }}</td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                    <div v-else-if="key1 == 'temperatura'">
                        <div class="text-lg text-center">Temperatura</div>
                        <ul class="list-disc list-inside m-2">
                            <li>Maxima: {{predition['maxima']}}</li>
                            <li>Minima: {{predition['minima']}}</li>
                        </ul>
                    </div>
                    <div v-else-if="key1 == 'sensTermica'">
                        <div class="text-lg text-center">Sensació tèrmica</div>
                        <ul class="list-disc list-inside m-2">
                            <li>Maxima: {{predition['maxima']}}</li>
                            <li>Minima: {{predition['minima']}}</li>
                        </ul>
                    </div>
                </div>
                <br>
            </div>
    </div>
    <div v-else-if="Object.keys(cityWeather).length == 0">
        No s'ha pogut recuperar la informació correctament!
    </div>
</template>