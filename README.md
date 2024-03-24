# Predicció meteorològica dels pobles d'Espanya

En aquest repositori hi ha una aplicació web feta amb Laravel & Vue3 & tailwindcss la qual està dividida en dos vistes:

1. La primera és bàsicament un buscador de ciutats i un botó per a poder buscar la ciutat.
2. Un cop buscades les ciutats, apareix un llistat d'aquestes en forma d'enllaços.
3. Al seleccionar a un d'aquests enllaços et redirigeix a una pantalla on apareix la predicció meteorològica corresponent.

Aquesta informació ha estat obtinguda a través de [l'API de la AEMET](https://opendata.aemet.es/dist/index.html#/predicciones-especificas/Predicci%C3%B3n%20por%20municipios%20diaria.%20Tiempo%20actual.) i el llistat de municipis de [l'institut nacional d'estadística](https://www.ine.es/daco/daco42/codmun/codmunmapa.htm)


La identificació dels codis dels municipis ha estat a base d'encert i error, ja que no apareix en cap lloc de la documentació, típic de les APIs públiques, el fet que no aparegui la informació. En definitiva, el codi del municipi que demana la API és el conjunt de dos camps, el CPRO i el CMUN.

Aquest llistat l'he deixat disponible dins del repositori, i es troba dins del CSV [citiesCodes.csv](https://github.com/cescFT/full-stack-vue-laravel/blob/main/citiesCodes.csv)

# Configuració

## Instal·lació de laravel & vue3 & tailwindcss
Per a instal·lar el laravel he anant buscant documentació per internet fins que tot m'ha funcionat. Els prerequisits és que tinguem instal·lat PHP8.1, composer i npm.

### Base de dades

Per tal de notrir la base de dades amb els municipis, el que he fet és genera-me un script en python, el qual genera un fitxer anomenat seedDB.sql (el qual he deixat comitejat).

Aquest fitxer el que fa és generar la base de dades, la taula i l'estructura de la taula on desarem les ciutats i els seus codis, anomenada "cities".

### Executar el projecte

0. Crear la base de dades mysql i executar el fitxer seedDB.sql
1. composer install
2. npm install
3. php artisan serve
4. npm run dev

Llavors en la url localhost:8000 estarà executant-se l'aplicació web i estarà tot preparat per funcionar.


### Millores

Sóc conscient que el fitxer .env no s'ha de comitejar MAI sota cap concepte a un repositori de gitlab, pero al tenir poc temps no he pogut crear-me un script o alguna cosa similar per anar a recuperar aquestes variables d'entorn a algun lloc, com podria ser al Paramer Store d'AWS.

Una altra cosa que m'hagués agradat molt d'implementar és fer vistes reaprofitables, ja que he duplicat molt de codi, cosa de la qual no estic orgullós, per tant, amb més temps, hagués buscat millor més bones pràctiques de Vue per a fer aquesta millora.

A més, sóc conscient que he harcodejat rutes, cosa que no és molt bo, ja que si per algun casual la ruta canvia, s'ha d'anar a canviar a tot arreu on apareix aquesta ruta. Però no he acabat d'entendre el concepte de route del Vue, amb més temps, ho hagués pensat millor i potser hagués utilitzat millor el tema del routing.

Una altra millora que podria haver fet és aplicar-li l'i18n (internacionalització).

Finalment, sóc totalment conscient que la vista que he creat no arriba a ser gran cosa, però amb el poc temps que he tingut, ho he intentat deixar almenys una mica responsive.

### Impediments

M'ha costat molt com fer anar el vue, fins ara només havia fet servir frameworks backend, com ara Django o Symfony amb les vistes Twig. Això m'ha fet perdre molt de temps, fins que no he entès que el laravel actua com una api rest i que el vue recull la informació que aquest li calcula, m'ha costat una mica. I la documentació que existeix a internet és molt escassa i no hi ha cap lloc que t'ho expliqui del tot bé.

Ara bé, un cop ho entens, per mi és una mica complicat, perquè el llenguatge que fa servir la vista no és molt "friendly", però bé, al final ho he trobat.

En resum, sóc un perfil més de backend que de frontend, m'hi sento més còmode.