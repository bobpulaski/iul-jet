<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;

class IulHistoryComponent extends Component
{
    public $historyData;
    public function mount()
    {
        $user = Auth::user();
        $this->historyData = $user->histories()->orderBy('created_at', 'desc')->get();

        Debugbar::warning($this->historyData);
    }

    public function render()
    {
        return view('livewire.iul-history-component', [
            'historyData' => $this->historyData,
        ]);
    }
}
