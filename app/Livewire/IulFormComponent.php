<?php

namespace App\Livewire;

use App\Models\User;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use Livewire\Attributes\On;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;

use App\Services\ReportService;
use App\Services\SigntaturesService;
use App\Services\UserSettingsService;
use App\Services\HistoryService;

use App\Models\SignsList;

use Laravel\Jetstream\InteractsWithBanner;

class IulFormComponent extends Component
{
    use InteractsWithBanner;

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

    public $signsList = [];
    public $isSignsListModalOpen = false;

     public function mount(UserSettingsService $settingsService, SigntaturesService $signtaturesService): void
    {
        $user = Auth::user();
        $this->signsList = $user->signslists()->select('kind', 'surname', 'file_src', 'id')->get()->toArray();

        // Если форма вызвана из Истории (есть id записи из таблицы истории)
        if (request()->id) {
            $user = Auth::user();
            $fromHistory = $user->histories->where('id', request()->id / 52)->first();
            if ($fromHistory) {
                $this->isTitle = $fromHistory->is_title;

                $this->name = $fromHistory->name;
                $this->orderNumber = $fromHistory->order_number;
                $this->documentDesignation = $fromHistory->document_designation;
                $this->documentName = $fromHistory->document_name;
                $this->versionNumber = $fromHistory->version_number;

                $this->isRememberSignatures = $fromHistory->remember_signatures;

                //TODO Думаю, это нужно вынести в отдельный метод
                // При редактировании листа ИУЛ из истории удаляю подписи из масива, которых
                // УЖЕ нет в справочнике подписей
                $this->responsiblePersons = json_decode($fromHistory->responsible_persons, true);
                // Получаем все ID записей из таблицы signs_lists
                $validSignIds = SignsList::pluck('id')->toArray();

                // Фильтруем массив ответственных лиц, оставляя только валидные записи

                $this->responsiblePersons = array_filter($this->responsiblePersons, function ($person) use ($validSignIds) {
                    return is_null($person['signs_lists_id']) || in_array($person['signs_lists_id'], $validSignIds);
                });
                // $this->responsiblePersons = array_filter($this->responsiblePersons, function ($person) use ($validSignIds) {
                //     return in_array($person['signs_lists_id'], $validSignIds);
                // });

                // Если необходимо, вы можете перезаписать JSON в базу данных
                $fromHistory->responsible_persons = json_encode(array_values($this->responsiblePersons));
                $fromHistory->save();
                //******************************************* */

                $this->algorithm = $fromHistory->algorithm;

                $this->isFooter = $fromHistory->is_footer;
                $this->description = $fromHistory->description;
                $this->page = $fromHistory->page;
                $this->pages = $fromHistory->pages;

                $this->fileType = $fromHistory->file_type;
                $this->headerType = $fromHistory->header_type;
            } else {
                abort(403, 'Unauthorized.');
            }
        } else {
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
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'documentDesignation' => 'required|min:3|max:255',
            'documentName' => 'required|min:3|max:255',
            'versionNumber' => 'required',
            'algorithm' => 'required',
        ];
    }

    protected function messages(): array
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

    public function start(UserSettingsService $settingsService, SigntaturesService $signtaturesService, HistoryService $historyService)
    {
        $this->validate($this->rules(), $this->messages());

        $this->responsiblePersons = array_map(function ($person) {
            return [
                'kind' => $person['kind'] ?? '',
                'surname' => $person['surname'] ?? '',
                'file_src' => $person['file_src'] ?? '',
                'signdate' => !empty($person['signdate']) ? $person['signdate'] : null,
                'signs_lists_id' => !empty($person['signs_lists_id']) ? $person['signs_lists_id'] : null,
            ];
        }, $this->responsiblePersons);

        // dd($this->responsiblePersons); // Это выведет массив всех signdate

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
        ];

        $reportService = new ReportService();
        $result = $reportService->generateReport($data, $this->fileType);
        $this->banner('Отчет успешно сохранён.');

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

        // Получаем ссылки на зависимость класса настроек пользователя и подписей
        $this->settingsService = $settingsService;
        $this->signtaturesService = $signtaturesService;
        $this->historyService = $historyService;

        if (is_bool($result) && $result === false) {
            // Если это HTML, вызываем событие на frontend для открытия новой вкладки
            $this->dispatch('redirectToReport');

            // Сохраняем настройки пользователя
            $this->settingsService->updateSettings($settingsData);
            $this->historyService->createHistory($historyData);

            // Сохраняем подписи ответственных лиц
            if ($this->isRememberSignatures === true) {
                $this->signtaturesService->createSigntatures($this->responsiblePersons);
            }
        } else {
            // Сохраняем настройки
            $this->settingsService->updateSettings($settingsData);
            $this->historyService->createHistory($historyData);

            if ($this->isRememberSignatures === true) {
                $this->signtaturesService->createSigntatures($this->responsiblePersons);
            }

            // Если это не HTML, то возвращаем результат, например, для загрузки

            return $result; // это будет response()->download($filePath);
        }
    }

    public function addToResponsiblePersons($kind, $surname, $file_src, $id): void
    {
        $this->responsiblePersons[] = [
            'kind' => $kind,
            'surname' => $surname,
            'signdate' => null,
            'file_src' => $file_src,
            'signs_lists_id' => $id,
        ];
    }

    public function addEmptySignToResponsiblePerson()
    {
        $this->responsiblePersons[] = [
            'kind' => '',
            'surname' => '',
            'signdate' => null,
            'file_src' => '',
            'signs_lists_id' => null,
        ];
    }

    public function showSignsListModal(): void
    {
        $this->isSignsListModalOpen = true;
    }

    // Удалять? Переработан функционал добавление подписей
    public function remove($index)
    {
        unset($this->responsiblePersons[$index]);
        // Переиндексация массива
        $this->responsiblePersons = array_values($this->responsiblePersons);

        Debugbar::info($this->responsiblePersons);
    }







    // TODO Убрать этот метод. Похоже, что дата у меня приходит с фронта уже форматированная
    // #[On('changeSignDateEvent')]
    // public function changeSignDate($signDateFromFront)
    // {
    //     if ($signDateFromFront === '') {
    //         // Используем оператор сравнения
    //         $this->signFormattedDate = '';
    //     } else {
    //         $this->signDate = $signDateFromFront;
    //         // Форматируем дату YYYY-MM-DD
    //         $date = $this->signDate; // Пример даты в формате YYYY-MM-DD
    //         $dateTime = new DateTime($date);
    //         $this->signFormattedDate = $dateTime->format('d.m.Y'); // Форматируем дату в DD.MM.YYYY
    //     }
    // }

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
