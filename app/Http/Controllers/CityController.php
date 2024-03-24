<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CityController extends Controller
{

    /** 
     * Aquesta acció el que permet és que quan l'usuari escriu alguna cosa al buscador de ciutats i li dona al botó de "buscar", s'executa aquesta acció
     * i et retorna un llistat de totes les ciutats on el seu nom s'assembla al que l'usuari ha escrit.
     */
    public function findCityByName($name)
    {
        return DB::table('cities')
            ->where('name', 'LIKE', "%$name%")
            ->get();
    }

}
