<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Barryvdh\Debugbar\Facades\Debugbar;

use App\Services\ReportService;
use App\Services\SigntaturesService;
use App\Services\UserSettingsService;
use App\Services\HistoryService;

use App\Models\History;
use DateTime;

class IulFormComponent extends Component
{
    public string $name = ''; //Наименование объекта
    public $orderNumber; //Номер п/п
    public string $documentDesignation = ''; //Обозначение документа
    public string $documentName = ''; //Наименование документа
    public int $versionNumber; //versionNumber

    public array $responsiblePersons = []; //Характер работы, Фамилия, Дата

    public array $fileData = []; //Данные файла, получаемые с Frontend
    public $signFormattedDate;

    public string $description = '';
    public $page;
    public $pages;

    public bool $isTitle = false;
    public bool $isRememberSignatures = true;
    public string $algorithm = 'md5';
    public bool $isFooter = false;
    public string $fileType = 'docx';
    public $headerType = 'regular';


    protected $settingsService;
    protected $signtaturesService;
    protected $historyService;

    private $settings;
    private $signtatures;
    public function mount(UserSettingsService $settingsService, SigntaturesService $signtaturesService)
    {
        //Получаем настройки пользователя
        $this->settingsService = $settingsService;
        $settings = $this->settingsService->getSettings();

        $this->settings = $settings;

        $this->isTitle = $settings->is_title;
        $this->isFooter = $settings->is_footer;
        $this->fileType = $settings->file_type;
        $this->algorithm = $settings->algorithm;
        $this->headerType = $settings->header_type;
        $this->isRememberSignatures = $settings->remember_signatures;

        //Получаем последние сохраненные подписи
        $this->signtaturesService = $signtaturesService;
        $signtatures = $this->signtaturesService->getSigntatures();
        $this->responsiblePersons = $signtatures->toArray();
    }



    // Правила валидации
    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'documentDesignation' => 'required|min:3|max:255',
            'documentName' => 'required|min:3|max:255',
            'versionNumber' => 'required',
            'algorithm' => 'required',
        ];
    }

    // Сообщения об ошибках
    protected function messages()
    {
        return [
            'name.required' => 'Поле обязательно для заполнения.',
            'name.min' => 'Поле должно содержать не менее 3 символов.',
            'name.max' => 'Поле не должно содержать более 255 символов.',

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
    public function start(UserSettingsService $settingsService, SigntaturesService $signtaturesService, HistoryService $historyService)
    {

        $this->validate($this->rules(), $this->messages());

        // Данные для формирования отчета
        $data = [
            'name' => $this->name,
            'orderNumber' => $this->orderNumber,
            'documentDesignation' => $this->documentDesignation,
            'documentName' => $this->documentName,
            'versionNumber' => $this->versionNumber,

            'responsiblePersons' => $this->responsiblePersons, //Массив подписей

            'fileData' => $this->fileData,

            'algorithm' => $this->algorithm,

            'description' => $this->description,
            'page' => $this->page,
            'pages' => $this->pages,

            'isTitle' => $this->isTitle,
            'headerType' => $this->headerType,
            'isFooter' => $this->isFooter,
            // 'signDate' => $this->signFormattedDate,
        ];

        $reportService = new ReportService();
        $result = $reportService->generateReport($data, $this->fileType);

        // Данные текущих настроек отчета
        $settingsData = [
            'is_title' => $this->isTitle,
            'is_footer' => $this->isFooter,
            'file_type' => $this->fileType,
            'algorithm' => $this->algorithm,
            'header_type' => $this->headerType,
            'remember_signatures' => $this->isRememberSignatures,
        ];

        // Данные для сохранения Истории
        $historyData = [
            'name' => $this->name,
            'order_number' => $this->orderNumber,
            'document_designation' => $this->documentDesignation,
            'document_name' => $this->documentName,
            'version_number' => $this->versionNumber,
            'responsible_persons' => json_encode($this->responsiblePersons, true),
            'hash' => $this->fileData[0]['hash'],
            'file_name' => $this->fileData[0]['fileName'],
            'formatted_date' => $this->fileData[0]['formattedDate'],
            'file_size' => $this->fileData[0]['fileSize'],
            'algorithm' => $this->algorithm,
            'description' => $this->description,
            'page' => $this->page,
            'pages' => $this->pages,
            'is_title' => $this->isTitle,
            'header_type' => $this->headerType,
            'is_footer' => $this->isFooter,
            'remember_signatures' => $this->isRememberSignatures,
            'file_type' => $this->fileType,
        ];

        Debugbar::info(is_array($this->responsiblePersons));

        // Получаем ссылки на зависимость класса настроек пользователя и подписей
        $this->settingsService = $settingsService;
        $this->signtaturesService = $signtaturesService;
        $this->historyService = $historyService;

        if (is_bool($result) && $result === false) {
            // Если это HTML, вызываем событие на frontend для открытия новой вкладки
            $this->dispatch('redirectToReport');

            //Сохраняем настройки пользователя
            $this->settingsService->updateSettings($settingsData);
            $this->historyService->createHistory($historyData);

            //Сохраняем подписи ответственных лиц
            if ($this->isRememberSignatures) {
                $this->signtaturesService->createSigntatures($this->responsiblePersons);
            }

        } else {
            // Сохраняем настройки
            $this->settingsService->updateSettings($settingsData);
            $this->historyService->createHistory($historyData);

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
        return view('livewire.iul-form-component');
    }

}
