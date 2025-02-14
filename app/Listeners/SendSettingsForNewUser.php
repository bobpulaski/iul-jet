<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserRegistered;
use App\Models\Settings;

class SendSettingsForNewUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        // dd($event);
        // Создание записи в таблице Settings со значениями по умолчанию
        $settings = new Settings();
        $settings->user_id = $event->user->id;
        $settings->save();
    }
}
