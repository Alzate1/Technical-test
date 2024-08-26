<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\City;

class UbicationController extends Controller
{
    // Método para obtener todos los países
    // Desarrollado por Juan Camilo Alzate
    public function allcountries()
    {
        try {
            // Obtener todos los países desde la base de datos
            $country = Country::all();
            return response()->json(['countries' => $country]);
        } catch (\Throwable $th) {
            // Manejo de excepciones y devolver un error 500
            return response()->json(['error' => 'Ocurrió un error al obtener los países', 'detalle' => $th->getMessage()], 500);
        }
    }

    // Método para obtener ciudades por ID de país
    public function getCitiesByCountry($countryId)
    {
        try {
            // Suponiendo que tienes una relación entre City y Country
            // Obtener las ciudades que pertenecen al país especificado
            $cities = City::where('country_id', $countryId)->get();

            return response()->json(['cities' => $cities]);
        } catch (\Throwable $th) {
            // Manejo de excepciones y devolver un error 500
            return response()->json(['error' => 'Ocurrió un error al obtener las ciudades', 'detalle' => $th->getMessage()], 500);
        }
    }
}
