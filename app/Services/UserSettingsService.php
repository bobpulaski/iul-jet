<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserSettingsService
{
    public function getSettings()
    {
        $user = Auth::user();
        $settings = $user->settings()->first();

        if (!$settings) {
            $user->settings()->create();
            $settings = $user->settings()->first(); // Повторно запрашиваем настройки
        }
        return $settings;
    }


    public function updateSettings($settingsData)
    {
        $user = Auth::user();
        $settings = $user->settings;

        if (!$settings) {
            return $user->settings()->create($settingsData);
        }
        return $settings->update($settingsData);
    }
}
