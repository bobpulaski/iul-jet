<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class ThanksComponent extends Component
{
    public int $amount;

    protected $rules = [
        'amount' => 'required|numeric|min:1',
    ];

    public function donateFix($fixAmount)
    {
        $this->amount = $fixAmount;
        $this->createPayment($this->amount);
    }


    public function donateFree()
    {
        $this->createPayment($this->amount);
    }

    public function createPayment($amount)
    {
        $this->validate();

        // Редирект на создание платежа
        // Простой редирект с параметрами
        return redirect()->route('payment.create', [
            'amount' => $this->amount,
            'user_name' => Auth::user()->name ?? 'Гость',
            'user_email' => Auth::user()->email ?? '@Гость'
        ]);
    }


    public function render()
    {
        return view('livewire.thanks-component');
    }
}
