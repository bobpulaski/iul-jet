<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SignsList;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Laravel\Jetstream\InteractsWithBanner;


class IulSignsListComponent extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public bool $isShowAddNewSignModal = false;

    public string $kind = '';
    public string $surname = '';

    public $signImageFile;

    protected function rules()
    {
        return [
            'kind' => 'required|min:3|max:50',
            'surname' => 'required|min:3|max:50',
            'signImageFile' => 'nullable|mimes:jpg,jpeg,png,bmp|max:2048',
        ];
    }

    protected function messages()
    {
        return [
            'kind.required' => 'Поле обязательно для заполнения.',
            'kind.min' => 'Поле должно содержать не менее 3 символов.',
            'kind.max' => 'Поле не должно содержать более 50 символов.',

            'surname.required' => 'Поле обязательно для заполнения.',
            'surname.min' => 'Поле должно содержать не менее 3 символов.',
            'surname.max' => 'Поле не должно содержать более 50 символов.',

            // 'signImageFile.required' => 'Пожалуйста, загрузите файл',
            // 'signImageFile.image' => 'Загрузите корректный файл. Разрешены только файлы в форматах jpg, jpeg, png, bmp.',
            'signImageFile.mimes' => 'Загрузите файл в одном из разрешенных форматов: jpg, jpeg, png, bmp.',
            'signImageFile.max' => 'Размер файла не должен превышать 2 MB',
        ];
    }

    public function save()
    {
        $this->validate($this->rules(), $this->messages());

        // dd($this->validate());

        try {
            $user = Auth::user();
            $user->signslists()->create([
                'kind' => $this->kind,
                'surname' => $this->surname,
            ]);
            $this->banner('Подпись успешно сохранена.');
        } catch (\Throwable $th) {
            $this->dangerBanner('Ошибка сохранения подписи.');
        }

        $this->resetErrorBag();
        $this->reset();
    }

    public function showAddNewSignModal()
    {
        $this->resetErrorBag();
        $this->reset();

        $this->isShowAddNewSignModal = true;
    }

    public function render()
    {
        $results = Auth::user()->signslists()->get();
        return view('livewire.iul-signs-list-component', [
            'signsData' => $results,
        ]);
    }
}