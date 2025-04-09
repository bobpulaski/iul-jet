<?php

namespace App\Listeners;

use App\Models\Signature;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserRegistered;
use App\Mail\UserRegisteredMail;
use App\Models\Settings;
use Illuminate\Support\Facades\Mail;

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
        // Создание записи в таблице Settings со значениями по умолчанию
        $settings = new Settings();
        $settings->user_id = $event->user->id;
        $settings->save();

        // Создание записи в таблице Signatures со значениями по умолчанию
        $signarures = new Signature();
        $signarures->user_id = $event->user->id;
        $signarures->save();

        $email = request('email');
        $userIp = request()->ip();
        Mail::to('mynameisempty@yandex.ru')->send(new UserRegisteredMail($userIp, $email));
    }
}
