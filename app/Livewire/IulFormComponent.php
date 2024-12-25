<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Helpers\FileChecksum;

class IulFormComponent extends Component
{
    use WithFileUploads;

    public $name = '';
    public $inputFile;
    public $orderNumber;
    public $documentDesignation = '';
    public $documentName = '';
    public $versionNumber;

    public function start()
    {
        $this->validate([
            'name' => 'required|min:3|max:255',
            'orderNumber' => 'required',
            'documentDesignation' => 'required|min:3|max:255',
            'documentName' => 'required|min:3|max:255',
            'versionNumber' => 'required',
            'inputFile' => 'required|file|max:81920',

        ], [
            'name.required' => 'Поле обязательно для заполнения',
            'name.min' => 'Поле должно содержать не менее 3 символов',
            'inputFile.required' => 'Пожалуйста, загрузите файл',
            'inputFile.file' => 'Загрузите корректный файл',
            'inputFile.max' => 'Размер файла не должен превышать 80 MB',
        ]);
        // $this->dispatch(event: 'create-iul-started');

        // Обработка загрузки файла, если он был загружен
        if ($this->inputFile) {
            $this->uploadFile();
        }
    }

    public function uploadFile()
    {
        $fileName = $this->inputFile->getClientOriginalName(); // Получение имени файла
        $this->inputFile->storeAs(path: 'uploads', name: $fileName); // Сохранение файла в папку 'uploads'


        // Находим путь к загруженному файлу

        $filePath = storage_path('app/private/uploads/' . $fileName);

        $fileChecksum = new FileChecksum();
        $hashCrc32 = $fileChecksum->getChecksumCrc32($filePath);

        dd($hashCrc32); // Вывод хеша для проверки
    }


    public function render()
    {
        return view('livewire.iul-form-component');
    }
}
