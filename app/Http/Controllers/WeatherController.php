<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\WeatherReports;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('weather')->with(['countries'=>config('countries')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $weather = $this->callWeather($request);

        $weather_report = new WeatherReports();

        $weather_report->country = $weather['country'];
        $weather_report->region = $weather['region'];
        $weather_report->timezone_id = $weather['timezone_id'];
        $weather_report->lon = $weather['lon'];
        $weather_report->lat = $weather['lat'];
        $weather_report->weather_description = $weather['weather_description'][0];
        $weather_report->temperature = $weather['temperature'];
        $weather_report->humidity = $weather['humidity'];
        $weather_report->wind_speed = $weather['wind_speed'];
        $weather_report->uv_index = $weather['uv_index'];
        $weather_report->wind_degree = $weather['wind_degree'];
        $weather_report->wind_direction = $weather['wind_direction'];
        $weather_report->visibility = $weather['visibility'];
        $weather_report->sunrise = $weather['sunrise'];
        $weather_report->sunset = $weather['sunset'];

        $weather_report->save();

        return view('weather')->with(['countries'=>config('countries'), 'weather' => $weather]);

    }

    /**
     * Request weather api
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function callWeather(Request $request) : array
    {
        $query = $request->city.', '.$request->country;

        $open_weather_response = Http::get('http://api.openweathermap.org/data/2.5/weather?q='.$query.'&appid='.config('api.open_weather_api_key'));
        $open_weather_data = json_decode($open_weather_response);

        $weatherstack_response = Http::get('http://api.weatherstack.com/current?access_key='.config('api.weather_stack_api_key').'&query='.$query);
        $weatherstack_data = json_decode($weatherstack_response);

        return [
            'country' => $weatherstack_data->location->country,
            'region' => $weatherstack_data->location->region,
            'timezone_id' => $weatherstack_data->location->timezone_id,
            'lon' => $weatherstack_data->location->lon,
            'lat' => $weatherstack_data->location->lat,
            'weather_description' => $weatherstack_data->current->weather_descriptions,
            'temperature' => ($weatherstack_data->current->temperature+($open_weather_data->main->temp / 10)) / 2,
            'humidity' => $weatherstack_data->current->humidity,
            'wind_speed' => $weatherstack_data->current->wind_speed,
            'uv_index' => $weatherstack_data->current->uv_index,
            'wind_degree' => $weatherstack_data->current->wind_degree,
            'wind_direction' => $weatherstack_data->current->wind_dir,
            'visibility' => $weatherstack_data->current->visibility,
            'sunrise' => $open_weather_data->sys->sunrise,
            'sunset' => $open_weather_data->sys->sunset,
            'weather_icon' => $weatherstack_data->current->weather_icons
        ];
    }

}
