<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class IulHistoryComponent extends Component
{
    public $historyData;
    public function mount()
    {
        $user = Auth::user();
        $this->historyData = $user->histories()->get();
        // dd($this->historyData);
    }

    public function render()
    {
        return view('livewire.iul-history-component', [
            'historyData' => $this->historyData,
        ]);
    }
}
