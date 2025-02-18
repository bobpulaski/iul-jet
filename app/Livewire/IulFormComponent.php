<?php

namespace App\Livewire;

use App\Helpers\ReportDocx;
use App\Helpers\ReportHtml;
use App\Helpers\ReportPdf;

use App\Helpers\FileInfo;
use App\Helpers\FileRemover;
use Illuminate\Support\Facades\Auth;


use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use DateTime;

class IulFormComponent extends Component
{
    use WithFileUploads;

    public $settings;
    public bool $isTitle = false;
    public bool $isFooter = false;
    public string $fileType = 'docx';
    public string $currentAlgorithm = 'md5';
    public function mount()
    {
        $user = Auth::user();
        $settings = $user->settings()->first();
        if (!$settings) {
            $settings = $user->settings()->create();
            $settings = $user->settings()->first();
            $this->settings = $settings;

            $this->isTitle = $this->settings->is_title;
            $this->isFooter = $this->settings->is_footer;
            $this->fileType = $this->settings->file_type;
            $this->currentAlgorithm = $this->settings->algorithm;
        } else {
            $this->settings = $settings;

            $this->isTitle = $this->settings->is_title;
            $this->isFooter = $this->settings->is_footer;
            $this->fileType = $this->settings->file_type;
            $this->currentAlgorithm = $this->settings->algorithm;
        }
    }


    public string $name = ''; //Наименование объекта
    public int $orderNumber; //Номер п/п
    public string $documentDesignation = ''; //Обозначение документа
    public string $documentName = ''; //Наименование документа
    public int $versionNumber; //versionNumber
    public $responsiblePersons = []; //Характер работы; Фамилия
    public array $fileData = []; //Данные файла, получаемые с Frontend

    // public string $currentAlgorithm = 'md5';

    public $headerType = 'regular';

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
    public function start()
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

        switch ($this->fileType) {
            case 'docx':
                $ReportDocx = new ReportDocx();
                $filePath = $ReportDocx->reportGenerate($data);

                $response = response()->download($filePath);

                $fileRemover = new FileRemover();
                $fileRemover->fileRemove($filePath);

                //Обновляем данные в таблице Settings
                $user = Auth::user();
                $settings = $user->settings;

                try {
                    if (!$settings) {
                        $settings = $user->settings()->create();
                    } else {
                        $settings->update([
                            'is_title' => $this->isTitle,
                            'is_footer' => $this->isFooter,
                            'file_type' => $this->fileType,
                            'algorithm' => $this->currentAlgorithm,
                        ]);
                    }
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }

                return $response;

            case 'html':
                $ReportHtml = new ReportHtml();
                $filePath = $ReportHtml->reportGenerate($data);

                $response = response()->download($filePath);

                $fileRemover = new FileRemover();
                $fileRemover->fileRemove($filePath);

                //Обновляем данные в таблице Settings
                $user = Auth::user();
                $settings = $user->settings;

                try {
                    if (!$settings) {
                        $settings = $user->settings()->create();
                    } else {
                        $settings->update([
                            'is_title' => $this->isTitle,
                            'is_footer' => $this->isFooter,
                            'file_type' => $this->fileType,
                            'algorithm' => $this->currentAlgorithm,
                        ]);
                    }
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }

                return $response;

                case 'pdf':
                    $ReportPdf = new ReportPdf();
                    $filePath = $ReportPdf->reportGenerate($data);
    
                    $response = response()->download($filePath);
    
                    $fileRemover = new FileRemover();
                    $fileRemover->fileRemove($filePath);
    
                    //Обновляем данные в таблице Settings
                    $user = Auth::user();
                    $settings = $user->settings;
    
                    try {
                        if (!$settings) {
                            $settings = $user->settings()->create();
                        } else {
                            $settings->update([
                                'is_title' => $this->isTitle,
                                'is_footer' => $this->isFooter,
                                'file_type' => $this->fileType,
                                'algorithm' => $this->currentAlgorithm,
                            ]);
                        }
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }
    
                    return $response;
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
