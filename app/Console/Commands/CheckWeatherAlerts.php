<?php
// app/Console/Commands/CheckWeatherAlerts.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WeatherAlert;
use App\Notifications\WeatherAlertNotification;
use App\Services\WeatherService;

class CheckWeatherAlerts extends Command
{
    protected $signature = 'weather:check-alerts';
    protected $description = 'Check weather alerts and notify users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(WeatherService $weatherService)
    {
        $alerts = WeatherAlert::where('is_active', true)->get();

        foreach ($alerts as $alert) {
            $weather = $weatherService->getWeather($alert->city);

            if (
                $weather['rain']['1h'] > $alert->precipitation_threshold ||
                $weather['uv_index'] > $alert->uv_index_threshold
            ) {
                $alert->user->notify(new WeatherAlertNotification([
                    'city' => $alert->city,
                    'precipitation' => $weather['rain']['1h'] ?? 0,
                    'uv_index' => $weather['uv_index'] ?? 0,
                ]));
            }
        }
    }
}
