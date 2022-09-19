<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request) {
      $request->validate([
        //Multiple worded cities must be formatted in the API request string with spaces
        //Therefore regex is used to include spaces - e.g. "Las Vegas"
        'city' => ['required', 'regex:/^[A-Za-z\s]*$/'],
        'country_code' => ['required', 'alpha']
      ]);
  
      $city = ucwords(strtolower($request->city));
      $country_code = $request->country_code;
  
      $api_key = env('WEATHER_API_KEY');
  
      $response = Http::get('https://api.openweathermap.org/data/2.5/weather?q=' . $city . ',' . $country_code. '&appid=' . $api_key . '&units=metric');
  
      //Get country name to send to the results view
      $country_arr = array_flip(config('countries'));
      $country = $country_arr[$country_code];
  
      if ($response->status() == 404) {
        $error_msg = "\"$city - $country\" was not found.";
        return view('welcome')->with('error_msg', $error_msg);
      }
  
      if ($response->status() != 200) {
        $error_msg = "Something went wrong with the request.";
        return view('welcome')->with('error_msg', $error_msg);
      }
  
      $json_arr = $response->json();
  
      $weather_info = array();
  
      //Main API results data
      $weather_info['Main temperature'] = $json_arr['main']['temp'] . '°C';
      $weather_info['Current weather'] = $json_arr['weather'][0]['main'] . ' - ' . $json_arr['weather'][0]['description'];
      $weather_info['"Feels like" temp'] = $json_arr['main']['feels_like'] . '°C';
      $weather_info['Humidity'] = $json_arr['main']['humidity'] . '%';
      $weather_info['Min temp'] = $json_arr['main']['temp_min'] . '°C';
      $weather_info['Max temp'] = $json_arr['main']['temp_max'] . '°C';
      //Rain index doesn't always exist so a check is required
      if (isset($json_arr['rain']['1h'])) {$weather_info['Rain in the last hour'] = $json_arr['rain']['1h'] . 'mm';}
      $weather_info['Wind speed'] = $json_arr['wind']['speed'] . ' mph';
  
      return view('result', [
        'city' => $city, 
        'country' => $country, 
        'country_code' => $country_code, 
        'info' => $weather_info
      ]);
    }
}
