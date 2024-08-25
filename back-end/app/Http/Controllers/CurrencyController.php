<?php

namespace App\Http\Controllers;

use App\Models\History;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Log;
use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Http;
class CurrencyController extends Controller
{
    public function weather($cityName)
    {
        try {

            $apiKey = env('OPENWEATHER_API_KEY');
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $cityName,
                'appid' => $apiKey,
                'units' => 'metric' // Obtener datos en grados Celsius
            ]);
            // if ($response->failed()) {
            //     return response()->json(['error' => 'Error al obtener datos del clima', 'message' => $response->json()], 500);
            // }
            // $weatherData = $response->json();
            // Extraer la información relevante
            //  $temperature = $weatherData['main']['temp']; // Temperatura actual en grados Celsius
            //  $description = $weatherData['weather'][0]['description']; // Descripción del clima//
            if ($response->successful()) {
                return $response->json()['main'];
            } else {
                throw new \Exception('Error al obtener el clima');
            }
            //  return response()->json([
            //     'temperature' => $temperature, // Temperatura actual en grados Celsius
            //     'description' => $description, // Descripción del clima

            // ]);
        } catch (\Throwable $th) {
            // Manejo de excepciones
            return response()->json(['error' => 'Ocurrió un error al obtener el clima', 'detalle' => $th->getMessage()], 500);
        }
    }
    private function getExchangeRate($currencyCode)
    {
        $apiKey = env('EXCHANGE_RATE_API_KEY');
        $baseCurrency = 'COP';
        $endpoint = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$baseCurrency}";
    
        try {
            $response = Http::get($endpoint);
    
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['conversion_rates'][$currencyCode])) {
                    return $data['conversion_rates'][$currencyCode];
                } else {
                    throw new \Exception("Tasa de cambio para la moneda {$currencyCode} no encontrada.");
                }
            } else {
                // Mostrar el cuerpo de la respuesta de error y el código de estado
                $errorResponse = $response->json();
                $statusCode = $response->status();
                $errorMessage = $errorResponse['error-type'] ?? 'Error desconocido';
    
                throw new \Exception("Error al obtener la tasa de cambio: {$errorMessage}. Código de estado: {$statusCode}");
            }
        } catch (\Exception $e) {
            // Mostrar detalles del error
            throw new \Exception("Excepción capturada: " . $e->getMessage());
        }
    }
  

    public function history(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'amount_cop' => 'required|numeric|min:0',
                'country_id' => 'required|exists:country,id',
                'city_id' => 'required|exists:city,id',
                'user_id' => 'required|exists:users,id'
            ]);
    
            // Obtener los datos del país y la ciudad
            $country = Country::findOrFail($request->input('country_id'));
            $city = City::findOrFail($request->input('city_id'));
    
            // Obtener el clima de la ciudad
            $weatherData = $this->weather($city->name);
            $temperature = $weatherData['temp'] ?? 'No disponible'; // Manejar el caso cuando no haya datos
    
            // Obtener la tasa de cambio
            $exchangeRate = $this->getExchangeRate($country->currency_code);
            
            // Verificar si la tasa de cambio es válida
            if (is_null($exchangeRate) || $exchangeRate == 0) {
                throw new \Exception("La tasa de cambio es inválida para la moneda {$country->currency_code}.");
            }
    
            // Calcular el monto convertido
            $convertedAmount = $request->input('amount_cop') * $exchangeRate;
    
            // Guardar en el historial
            $history = new History();
            $history->user_id = $request->input('user_id');
            $history->country_id = $request->input('country_id');
            $history->city_id = $request->input('city_id');
            $history->amount_cop = $request->input('amount_cop');
            $history->current_amount = $convertedAmount; 
            $history->exchange_rate = $exchangeRate;
            $history->date = now()->toDateString();
            $history->temperature = $temperature;
            $history->currency_symbol = $country->currency_symbol;
            $history->currency_name = $country->currency_name;
            $history->save();
    
            // Devolver todos los detalles procesados
            return response()->json([
                'exitoso' => true,
                'amount_cop' => $request->input('amount_cop'),
                'city' => $city->name,
                'country' => $country->name,
                'temperature' => $temperature,
                'currency_name' => $country->currency_name,
                'currency_symbol' => $country->currency_symbol,
                'converted_amount' => $convertedAmount . ' ' . $country->currency_symbol,
                'exchange_rate' => $exchangeRate,
            ]);
        } catch (\Throwable $th) {
            // Manejo de errores
            return response()->json(['error' => 'Ocurrió un error al procesar los detalles', 'detalle' => $th->getMessage()], 500);
        }
    }
    
    public function getHistory(){
        try{
            $history=History::orderBy('created_at','desc')->take(5)->get();
            return response()->json($history);
        }catch(\Throwable $th) {
            return response()->json(['error' => 'Ocurrió un error al obtener el historial', 'detalle' => $th->getMessage()], 500);
        }
    }
   
}
