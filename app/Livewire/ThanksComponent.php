<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ThanksComponent extends Component
{
    public int $sum;

    #[Validate('required|integer')]
    public int $freeSum;

    public function donateFix($sum)
    {
        dd(Auth::user()->name . ' ' . Auth::user()->email . ' ' . $sum);
    }

    public function donateFree()
    {
        $this->validate();
        dd($this->only(['freeSum']));
    }

    public function render()
    {
        return view('livewire.thanks-component');
    }
}
