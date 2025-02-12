<?php

namespace App\Livewire;

use App\Helpers\ReportDocx;
use App\Helpers\FileInfo;
use App\Helpers\FileRemover;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use DateTime;

class IulFormComponent extends Component
{
    use WithFileUploads;

    public string $name = ''; //Наименование объекта
    public int $orderNumber; //Номер п/п
    public string $documentDesignation = ''; //Обозначение документа
    public string $documentName = ''; //Наименование документа
    public int $versionNumber; //versionNumber
    public $responsiblePersons = []; //Характер работы; Фамилия
    public array $fileData = []; //Данные файла, получаемые с Frontend

    public string $currentAlgorithm = 'md5';
    public $fileType = 'docx';
    public $headerType = 'regular';
    public bool $isTitle = true;
    public bool $isFooter = true;
    public $signFormattedDate;
    public bool $rememberResponsiblePersons = false;

    public string $description = '';
    public int $page;
    public int $pages;

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

            'documentName.required' => 'Поле обязательно для заполнения.',
            'documentName.min' => 'Поле должно содержать не менее 3 символов.',
            'documentName.max' => 'Поле не должно содержать более 255 символов.',

            'versionNumber.required' => 'Поле обязательно для заполнения.',

            'inputFile.required' => 'Пожалуйста, загрузите файл',
            'inputFile.file' => 'Загрузите корректный файл',
            'inputFile.max' => 'Размер файла не должен превышать 80 MB',
        ];
    }

    //Основной алгоритм формирования очета
    public function start()
    {
        // dd($this->responsiblePersons);

        $this->validate($this->rules(), $this->messages());

        $data = [
            'fileData' => $this->fileData,
            'name' => $this->name,
            'orderNumber' => $this->orderNumber,
            'documentDesignation' => $this->documentDesignation,
            'documentName' => $this->documentName,
            'versionNumber' => $this->versionNumber,
            'currentAlgorithm' => $this->currentAlgorithm,
            'responsiblePersons' => $this->responsiblePersons,
            'headerType' => $this->headerType,
            'isTitle' => $this->isTitle,
            'signDate' => $this->signFormattedDate,
            // 'fileType' => $this->fileType,
        ];

        switch ($this->fileType) {
            case 'docx':
                $ReportDocx = new ReportDocx();
                $filePath = $ReportDocx->reportGenerate($data);

                $response = response()->download($filePath);

                $fileRemover = new FileRemover();
                $fileRemover->fileRemove($filePath);

                return $response;

            case 'html':
                dd('HTML');
        }
    }

    #[On('changeSignDateEvent')]
    public function changeSignDate($signDateFromFront)
    {
        if ($signDateFromFront === '') { // Используем оператор сравнения
            $this->signFormattedDate = '';
        } else {
            $this->signDate = $signDateFromFront;
            // Форматируем дату YYYY-MM-DD
            $date = $this->signDate; // Пример даты в формате YYYY-MM-DD
            $dateTime = new DateTime($date);
            $this->signFormattedDate = $dateTime->format('d.m.Y'); // Форматируем дату в DD.MM.YYYY
        }
    }

    //Слушатель события получения информации о файле с Frontend
    #[On('compose')]
    public function fileModifiedDate($fileData)
    {
        $this->fileData = [$fileData];
    }

    public function render()
    {
        return view('livewire.iul-form-component');
    }
}
