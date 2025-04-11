<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SignsList;
use Illuminate\Support\Facades\Auth;

class IulSignsListComponent extends Component
{

    public bool $isShowAddNewSignModal = false;
    public array $signsList = [];

    public function showAddNewSignModal()
    {
        $this->isShowAddNewSignModal = true;
    }

    public function render()
    {
        $results = Auth::user()->signslist();

        return view('livewire.iul-signs-list-component', [
            'signsData' => $results,
        ]);
    }
}
