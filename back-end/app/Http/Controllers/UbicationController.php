<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;

class UbicationController extends Controller
{
    public function allcountries(){
        try{
            $country = Country::all();
            return response()->json(['countries'=>$country]);
        }catch (\Throwable $th) {
            // Manejo de excepciones
            return response()->json(['error' => 'Ocurrió un error al obtener los paises', 'detalle' => $th->getMessage()], 500);
        }
    }
    public function allcities(){
        try{
            $cities = City::all();
            return response()->json(['cities'=>$cities]);
        }catch (\Throwable $th) {
            // Manejo de excepciones
            return response()->json(['error' => 'Ocurrió un error al obtener los paises', 'detalle' => $th->getMessage()], 500);
        }
    }
}
