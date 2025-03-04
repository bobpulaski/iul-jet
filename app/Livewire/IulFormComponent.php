<?php

namespace App\Livewire;

use App\Helpers\ReportDocx;
use App\Helpers\ReportPdf;
use App\Services\ReportService;
use App\Services\UserSettingsService;


// use App\Helpers\FileInfo;
// use App\Helpers\FileRemover;
use App\Models\History;
use Illuminate\Support\Facades\Auth;


use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use DateTime;

class IulFormComponent extends Component
{
    protected $settingsService;

    public $settings;
    public bool $isTitle = false;
    public bool $isFooter = false;
    public string $fileType = 'docx';
    public string $currentAlgorithm = 'md5';
    public $headerType = 'regular';

    public function mount(UserSettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
        $settings = $this->settingsService->getSettings();

        $this->settings = $settings;

        $this->isTitle = $settings->is_title;
        $this->isFooter = $settings->is_footer;
        $this->fileType = $settings->file_type;
        $this->currentAlgorithm = $settings->algorithm;
        $this->headerType = $settings->header_type;
    }


    public string $name = ''; //Наименование объекта
    public int $orderNumber; //Номер п/п
    public string $documentDesignation = ''; //Обозначение документа
    public string $documentName = ''; //Наименование документа
    public int $versionNumber; //versionNumber
    public $responsiblePersons = []; //Характер работы; Фамилия
    public array $fileData = []; //Данные файла, получаемые с Frontend
    public $signFormattedDate;
    public bool $rememberResponsiblePersons = false;

    public string $description = '';
    public $page;
    public $pages;




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
    public function start(UserSettingsService $settingsService)
    {

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
            'isFooter' => $this->isFooter,
            'signDate' => $this->signFormattedDate,
            'description' => $this->description,
            'page' => $this->page,
            'pages' => $this->pages,
        ];

        $reportService = new ReportService();
        $result = $reportService->generateReport($data, $this->fileType);

        // Данные текущих настроек отчета
        $settingsData = [
            'is_title' => $this->isTitle,
            'is_footer' => $this->isFooter,
            'file_type' => $this->fileType,
            'algorithm' => $this->currentAlgorithm,
            'header_type' => $this->headerType,
        ];

        // Получаем ссылку на зависимость класса настроек пользователя
        $this->settingsService = $settingsService;

        if (is_bool($result) && $result === false) {
            // Если это HTML, вызываем событие на frontend для открытия новой вкладки
            $this->dispatch('redirectToReport');

            // Сохраняем настройки
            $this->settingsService->updateSettings($settingsData);
        } else {
            // Сохраняем настройки
            $this->settingsService->updateSettings($settingsData);

            // Если это не HTML, то возвращаем результат, например, для загрузки
            return $result; // это будет response()->download($filePath);

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
        if (count($this->getErrorBag()->all()) > 0) {
            dd('ee');
        }
        return view('livewire.iul-form-component');
    }


}
