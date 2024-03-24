<script setup>
import axios from "axios"
import { ref, onMounted } from 'vue'

const cities = ref([])
const getCities = () => {
    axios.get('/fetchCityByName/a')
    .then(res => cities.value = res.data)
    .catch(error => console.log(error))
}


onMounted(() => getCities())

</script>

<template>
    <div>
        <ul>
            <li v-for="city in cities" :key="city.id">
                <h2>{{ city.name }}</h2>
            
            </li>
        </ul>
    </div>

</template>