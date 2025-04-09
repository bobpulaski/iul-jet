<?php

namespace App\Livewire;

use App\Mail\SupportRequestSendedMail;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Enums\SupportRequestTypeEnum;
use Laravel\Jetstream\InteractsWithBanner;
use Illuminate\Support\Facades\Mail;

class IulSupportComponent extends Component
{
    use InteractsWithBanner;

    public string $requestType;
    public string $requestSubject;
    public string $requestBody;
    public function mount()
    {
        $this->requestType = SupportRequestTypeEnum::QUESTION->value;
    }

    public function send()
    {
        Debugbar::info($this->requestType);
        Debugbar::info($this->requestSubject);
        Debugbar::info($this->requestBody);

        $this->banner('Ваше обращение успешно отправлено.Через 5 секунд вы будете перенаправлены на страницу Конструктора.');

        $userName = Auth::user()->name;
        $userEmail = Auth::user()->email;
        $userIp = request()->ip();
        Mail::to('support@quatros.ru')->send(new SupportRequestSendedMail($userName, $userEmail, $userIp, $this->requestType, $this->requestSubject, $this->requestBody));

        $this->dispatch('show-banner-and-redirect');
    }

    public function render()
    {
        return view('livewire.iul-support-component', [
            'requestTypes' => SupportRequestTypeEnum::cases(),
        ]);
    }
}
