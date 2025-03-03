<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserSettingsService
{
    public function getSettings()
    {
        $user = Auth::user();
        return $user->settings()->first() ?: $user->settings()->create();
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
