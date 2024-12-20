<?php

namespace App\Livewire;

use Livewire\Component;

class IulFormComponent extends Component
{

    public function start()
    {
        $this->dispatch(event: 'create-iul-started');
    }


    public function render()
    {
        return view('livewire.iul-form-component');
    }
}
