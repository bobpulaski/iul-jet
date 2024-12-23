<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Helpers\FileChecksum;

class IulFormComponent extends Component
{
    use WithFileUploads;

    #[Validate('file|max:81920')] // 80MB Max
    public $inputFile;


    public function start()
    {
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
