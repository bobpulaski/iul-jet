<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Helpers\FileInfo;
use Illuminate\Support\Facades\Storage;

class IulFormComponent extends Component
{
    use WithFileUploads;

    public $name = '';

    public $inputFile;
    public $modifiedDate;
    protected $listeners = ['fileModifiedDate'];

    public $orderNumber;
    public $documentDesignation = '';
    public $documentName = '';
    public $versionNumber;

    public $responsiblePersons = [];

    public $currentAlgorithm = 'crc32';

    public function start()
    {
        // dd($this->currentAlgorithm);

        $this->validate(
            [
                'name' => 'required|min:3|max:255',
                'orderNumber' => 'required',
                'documentDesignation' => 'required|min:3|max:255',
                'documentName' => 'required|min:3|max:255',
                'versionNumber' => 'required',
                'currentAlgorithm' => 'required',

                'inputFile' => 'required|file|max:81920',
            ],
            [
                'name.required' => 'Поле обязательно для заполнения',
                'name.min' => 'Поле должно содержать не менее 3 символов',
                'inputFile.required' => 'Пожалуйста, загрузите файл',
                'inputFile.file' => 'Загрузите корректный файл',
                'inputFile.max' => 'Размер файла не должен превышать 80 MB',
            ],
        );
        // $this->dispatch(event: 'create-iul-started');

        // Обработка загрузки файла, если он был загружен

        if ($this->inputFile) {
            $this->uploadFile();
        }
    }

    public function fileModifiedDate($date)
    {
        $this->modifiedDate = $date; // Store the modified date
        dd(vars: $this->modifiedDate);
    }
    public function uploadFile()
    {
        // $fileName = $this->inputFile->getClientOriginalName();

        // Получение оригинальной даты изменения перед загрузкой
        // $originalFilePath = $this->inputFile->getRealPath(); // Путь к оригинальному файлу до загрузки
        // $originalModifiedTime = filemtime($originalFilePath); // Получаем оригинальную дату изменения
        // $fileModifiedDateTime = date('d-m-Y H:i:s', $originalModifiedTime); // Форматируем метку времени в читаемый вид
        // dd($fileModifiedDateTime);


        $fileInfo = new FileInfo();
        $fileName = $fileInfo->getFileName($this->inputFile);
        $fileSize = $fileInfo->getFileSize($this->inputFile);

        // Сохранение файла в папку 'uploads'
        $this->inputFile->storeAs('uploads', $fileName, 'local');

        // Находим путь к загруженному файлу
        $filePath = storage_path('/app/private/uploads/' . $fileName);

        // Получаем дату и время последнего изменения файла
        // $fileModifiedTime = Storage::lastModified($filePath); // Это вернет метку времени
        // $fileModifiedTime = Storage::disk('local')->lastModified('uploads/' . $fileName);
        // $fileModifiedTime = $fileInfo->getFileModifiedDateTime($filePath);
        // $fileModifiedDateTime = date('d-m-Y H:i:s', $fileModifiedTime); // Форматируем метку времени в читаемый вид

        $hashCrc32 = $fileInfo->getChecksumCrc32($filePath);

        // Выводим информацию о файле
        dd([
            '$fileName' => $fileName,
            'fileSize' => $fileSize, // Размер файла
            'fileChecksum' => $hashCrc32, // Хэш для проверки
        ]);
    }

    public function render()
    {
        return view('livewire.iul-form-component');
    }
}
