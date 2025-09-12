<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class ThanksComponent extends Component
{
    public int $amount;
    public int $freeAmount;

    protected $rules = [
        'amount' => 'required|numeric|min:1',
    ];

    public function donateFix($fixAmount)
    {
        $this->amount = $fixAmount;
        $this->createPayment();
    }


    public function donateFree()
    {
        $this->amount = $this->freeAmount;
        $this->createPayment();
    }

    public function createPayment()
    {
        // Редирект на создание платежа
        // Простой редирект с параметрами
        return redirect()->route('payment.create', [
            'amount' => $this->amount,
            'user_name' => Auth::user()->name ?? 'Гость',
            'user_email' => Auth::user()->email ?? 'mynameisempty@yandex.ru'
        ]);
    }


    public function render()
    {
        return view('livewire.thanks-component');
    }
}
