<?php

namespace App\Livewire;

use Livewire\Component;
use App\Enums\SupportRequestType;

class IulSupportComponent extends Component
{
    public string $type;
    public function mount()
    {
        $this->type = SupportRequestType::QUESTION->value;
    }

    public function send()
    {
        dd((string) $this->type);

    }
    public function render()
    {
        return view('livewire.iul-support-component', [
            'types' => SupportRequestType::cases(),
        ]);
    }
}
