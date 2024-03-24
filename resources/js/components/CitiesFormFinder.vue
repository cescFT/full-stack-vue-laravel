<template>

    <div class="p-3">
        <div class="m-1">
            Al seguent formulari busca el teu municipi i al donar-li a buscar et trobarà el temps que hi ha ara!
        </div>
        <div class="flex mb-3">   
            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="cityToFind" id="cityToFind" placeholder="Busca el teu municipi...">
            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"  @click="searchCities()">Buscar</button>
        </div>

        <div id="citiesResult">

        </div>
        
    </div>
    
</template>

<script>
export default {
    methods: {
            searchCities() {
                const textSearched = document.querySelector('#cityToFind');
                const cityResultDiv = document.querySelector('#citiesResult');

                fetch('/fetchCityByName/' + textSearched.value, {method: 'GET'})
                .then(response => response.json())
                .then(body => {
                    let hasResult = false
                    let ul = document.createElement('ul')
                    ul.classList.add("list-disc");
                    ul.classList.add("list-inside");

                    cityResultDiv.innerHTML = ''
                    for (const [key, value] of Object.entries(body)) {
                        hasResult = true
                        let li = document.createElement('li')
                        li.innerHTML = '<a href="/cityWeatherResult?cityId='+value.id+'" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" target="_blank">'+ value.id +'-'+ value.name +'</a>';
                        ul.appendChild(li)
                    }

                    if (!hasResult) {
                        alert('No hi ha la ciutat que demanes carregada al nostre sistema.')
                    } else {
                        cityResultDiv.innerHTML = '<h2>Llistat de ciutats:</h2>';
                        cityResultDiv.appendChild(ul)
                    }
                });

            }
    }
}
</script>
