<?php

namespace App\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Models\SignsList;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Laravel\Jetstream\InteractsWithBanner;
use Illuminate\Support\Facades\Log;


class IulSignsListComponent extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    // protected $logger;
    // public function __construct(LoggerService $logger)
    // {
    //     $this->logger = $logger;
    // }



    public bool $isShowAddNewSignModal = false;

    public string $kind = '';
    public string $surname = '';
    public $signImageFile = null;

    public string $filePath = '';

    protected function rules(): array
    {
        return [
            'kind' => 'required|min:3|max:50',
            'surname' => 'required|min:3|max:50',
            // 'signImageFile' => 'nullable|c',
        ];
    }

    protected function messages(): array
    {
        return [
            'kind.required' => 'Поле обязательно для заполнения.',
            'kind.min' => 'Поле должно содержать не менее 3 символов.',
            'kind.max' => 'Поле не должно содержать более 50 символов.',

            'surname.required' => 'Поле обязательно для заполнения.',
            'surname.min' => 'Поле должно содержать не менее 3 символов.',
            'surname.max' => 'Поле не должно содержать более 50 символов.',

            'signImageFile.required' => 'Пожалуйста, загрузите файл',
            'signImageFile.image' => 'Загрузите корректный файл. Разрешены только файлы в форматах jpg, jpeg, png, bmp.',
            'signImageFile.mimes' => 'Загрузите файл в одном из разрешенных форматов: jpg, jpeg, png, bmp.',
            'signImageFile.max' => 'Размер файла не должен превышать 2 MB',
        ];
    }

    public function save(): void
    {
        // Сначала валидируем остальные поля
        $this->validate($this->rules(), $this->messages());

        // Проверяем, есть ли файл signImageFile
        if ($this->signImageFile) {
            // Если файл есть, валидируем его отдельно
            $this->validate([
                'signImageFile' => 'required|mimes:jpg,jpeg,png,bmp|max:2048',  // Ваши правила валидации
            ]);

            $folderName = Auth::user()->id . '-' . Auth::user()->email;
            // Сохраняем файл и получаем полный путь
            $this->filePath = $this->signImageFile->store('signs-files/' . $folderName, 'public');
            Debugbar::info('$filePath:' . $this->filePath);

            // Извлекаем имя файла из полного пути
            $savedFileName = basename($this->filePath);
            Debugbar::info('$savedFileName' . $savedFileName);

            // Верный путь для asset
            $relativePath = 'storage/signs-files/' . $folderName . '/' . $savedFileName;
            Debugbar::info('Saved file name:' . asset($relativePath));

            // Формируем полный путь к файлу
            $fullFilePath = storage_path('app/' . $this->filePath);
            Debugbar::alert($fullFilePath);


        } else {
            Debugbar::info('File not provided, skipping validation.');
            $this->reset();
        }


        try {
            $user = Auth::user();
            $user->signslists()->create([
                'kind' => $this->kind,
                'surname' => $this->surname,
                'file_src' => $this->filePath,
            ]);
            $this->banner('Подпись успешно сохранена.');
        } catch (\Throwable $th) {
            $this->dangerBanner('Ошибка сохранения подписи.');
            // Получаем имя класса и метода
            $className = __CLASS__; // Текущий класс
            $methodName = __FUNCTION__; // Текущий метод
            $message = $th->getMessage();

            // Логируем или отображаем информацию
            Log::channel('my_log_channel')->error("Ошибка в классе: {$className}, методе: {$methodName}. Сообщение: {$message}");
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
        $results = Auth::user()->signslists()->orderBy('created_at', 'desc')->get();
        return view('livewire.iul-signs-list-component', [
            'signsData' => $results,
        ]);
    }
}
