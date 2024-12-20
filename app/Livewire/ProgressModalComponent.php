<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ProgressModalComponent extends Component
{
    public $isOpen = false;

    #[On('create-iul-started')]
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.progress-modal-component');
    }
}
