<?php

namespace App\Services;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;

class HistoryService
{
    public function createHistory($historyData)
    {
        $user = Auth::user();
        $user->histories()->create($historyData);
    }
}
