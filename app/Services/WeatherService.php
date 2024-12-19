<?php
// app/Services/WeatherService.php
namespace App\Services;

use GuzzleHttp\Client;

class WeatherService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openweathermap.org/data/2.5/',
        ]);
    }

    public function getWeather(string $city): array
    {
        $response = $this->client->get('weather', [
            'query' => [
                'q' => $city,
                'appid' => env('OPENWEATHER_API_KEY'),
                'units' => 'metric',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
