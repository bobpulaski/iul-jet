<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Helpers\FileInfo;
use Livewire\Attributes\On;

class IulFormComponent extends Component
{
    use WithFileUploads;

    // Состояние компонента
    public string $name = '';
    public $inputFile;
    public $formattedDate;
    public int $orderNumber;
    public string $documentDesignation = '';
    public string $documentName = '';
    public int $versionNumber;
    public $responsiblePersons = [];
    public string $currentAlgorithm = 'crc32';

    // Правила валидации
    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'orderNumber' => 'required',
            'documentDesignation' => 'required|min:3|max:255',
            'documentName' => 'required|min:3|max:255',
            'versionNumber' => 'required',
            'currentAlgorithm' => 'required',
            'inputFile' => 'required|file|max:81920',
        ];
    }

    // Сообщения об ошибках
    protected function messages()
    {
        return [
            'name.required' => 'Поле обязательно для заполнения.',
            'name.min' => 'Поле должно содержать не менее 3 символов.',
            'name.max' => 'Поле не должно содержать более 255 символов.',

            'orderNumber.required' => 'Поле обязательно для заполнения.',

            'documentDesignation.required' => 'Поле обязательно для заполнения.',
            'documentDesignation.min' => 'Поле должно содержать не менее 3 символов.',
            'documentDesignation.max' => 'Поле не должно содержать более 255 символов.',

            'versionNumber.required' => 'Поле обязательно для заполнения.',

            'inputFile.required' => 'Пожалуйста, загрузите файл',
            'inputFile.file' => 'Загрузите корректный файл',
            'inputFile.max' => 'Размер файла не должен превышать 80 MB',
        ];
    }

    public function start()
    {
        $this->validate($this->rules(), $this->messages());

        if ($this->inputFile) {
            $this->uploadFile();
        }
    }

    #[On('file-selected')]
    public function fileModifiedDate($formattedDate)
    {
        $this->formattedDate = $formattedDate;
    }

    public function uploadFile()
    {
        // dd($this->responsiblePersons);

        $fileInfo = new FileInfo();

        // Получаем информацию о файле
        $fileName = $fileInfo->getFileName($this->inputFile);
        $fileSize = $fileInfo->getFileSize($this->inputFile);

        // Сохраняем файл и вычисляем его хэш
        $this->saveFile($fileName);
        $filePath = storage_path('app/private/uploads/' . $fileName);

        $hashCrc32 = $fileInfo->getChecksumCrc32($filePath);
        $hashMd5 = $fileInfo->getChecksumMd5($filePath);
        $hashSha1 = $fileInfo->getChecksumSha1($filePath);

        // Выводим информацию о файле
        $this->outputFileInfo($fileName, $fileSize, $hashCrc32, $hashMd5, $hashSha1);
    }

    protected function saveFile($fileName)
    {
        $this->inputFile->storeAs('uploads', $fileName, 'local');
    }

    protected function outputFileInfo($fileName, $fileSize, $hashCrc32, $hashMd5, $hashSha1)
    {
        dd([
            'name' => $this->name,
            'orderNumber' => $this->orderNumber,
            'documentDesignation' => $this->documentDesignation,
            'documentName' => $this->documentName,
            'versionNumber' => $this->versionNumber,
            'responsiblePersons' => $this->responsiblePersons,
            'currentAlgorithm' => $this->currentAlgorithm,


            'fileName' => $fileName,
            'fileSize' => $fileSize,
            'fileModifiedDate' => $this->formattedDate,
            'fileChecksumCrc32' => $hashCrc32,
            'fileChecksumMd5' => $hashMd5,
            'fileChecksumSha1' => $hashSha1,
        ]);
    }

    public function render()
    {
        return view('livewire.iul-form-component');
    }
}
