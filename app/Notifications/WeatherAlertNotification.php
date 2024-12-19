<?php

// app/Notifications/WeatherAlertNotification.php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WeatherAlertNotification extends Notification
{
    use Queueable;

    public $weatherData;

    public function __construct(array $weatherData)
    {
        $this->weatherData = $weatherData;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Weather Alert Notification')
            ->line('Attention: Extreme weather conditions detected.')
            ->line("City: {$this->weatherData['city']}")
            ->line("Precipitation Level: {$this->weatherData['precipitation']}")
            ->line("UV Index: {$this->weatherData['uv_index']}")
            ->action('Check Weather', url('/'))
            ->line('Stay safe!');
    }
}
