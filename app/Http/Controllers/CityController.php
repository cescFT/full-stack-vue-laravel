<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CityController extends Controller
{

    public function findCityByName($name)
    {
        return DB::table('cities')
            ->where('name', 'LIKE', "%$name%")
            ->get();
    }

}
