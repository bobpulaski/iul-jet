<?php

namespace App\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Laravel\Jetstream\InteractsWithBanner;
use Illuminate\Support\Facades\Log;
use App\Models\SignsList;


class IulSignsListComponent extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public bool $isShowAddNewSignModal = false;
    public bool $isShowConfirmingSignDeletionModal = false;

    public string $kind = '';
    public string $surname = '';

    //     #[Validate('nullable|image|extensions:jpg, jpeg, png, bmp|max:2048')]
    public $signImageFile;

    public string $filePath = '';

    public int $signId;

    protected function rules(): array
    {
        return [
            'kind' => 'required|min:1|max:50',
            'surname' => 'required|min:1|max:50',
            'signImageFile' => 'bail|nullable|image|mimes:jpg,jpeg,png,bmp|max:2048',
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
            'signImageFile.extensions' => 'Загрузите файл в одном из разрешенных форматов: jpg, jpeg, png, bmp.',
            'signImageFile.max' => 'Размер файла не должен превышать 2 MB (компонет)',
        ];
    }

    public function suka(): void
    {
        $this->resetErrorBag('signImageFile');
        $this->signImageFile = null;
    }

    public function save(): void
    {


        $this->validate($this->rules(), $this->messages());

        if (!$this->signImageFile) {
            Debugbar::info('Файла с изображением не указан');
        } else {

            // Валидация файла
            try {
                $this->validate([
                    'signImageFile' => 'nullable|image|mimes:jpg,jpeg,png,bmp|max:2048', // Настройте правила валидации по необходимости
                ]);

                // Сохранение файла
                $folderName = Auth::user()->id . '-' . Auth::user()->email;
                $this->filePath = $this->signImageFile->store('signs-files/' . $folderName, 'public');

            } catch (ValidationException $e) {
                // Если валидация не прошла, удалить временный файл
                if ($this->signImageFile) {
                    @unlink($this->signImageFile->getRealPath());
                    // Можно также выбросить ошибку или вывести сообщение
//                    $this->addError('signImageFile', 'Файл не прошел валидацию.');
                    Debugbar::alert($e->getMessage());
                }

            }

            /* // Логика загрузки файла (например, сохранение на сервер)
             Debugbar::info('Файл хороший!');
             $folderName = Auth::user()->id . '-' . Auth::user()->email;
             $this->filePath = $this->signImageFile->store('signs-files/' . $folderName, 'public');*/
        }

        try {
            $user = Auth::user();
            $user->signslists()->create([
                'kind' => $this->kind,
                'surname' => $this->surname,
                'file_src' => $this->filePath,
            ]);

            $this->banner('Подпись успешно сохранена.');

            $this->signImageFile = null;
        } catch (\Throwable $th) {
            $this->dangerBanner('Ошибка сохранения подписи.');

            // Получаем имя класса и метода
            $className = __CLASS__; // Текущий класс
            $methodName = __FUNCTION__; // Текущий метод
            $message = $th->getMessage();
            Log::channel('my_log_channel')->error("Ошибка в классе: {$className}, методе: {$methodName}. Сообщение: {$message}");
        }

        $this->resetErrorBag();
        $this->reset();
    }

    public function showAddNewSignModal()
    {
        $this->resetErrorBag();
        $this->reset();
        $this->signImageFile = null;

        $this->isShowAddNewSignModal = true;
    }

    public function showConfirmingSignDeletion($id)
    {
        $this->signId = $id;
        $this->isShowConfirmingSignDeletionModal = true;
    }

    public function deleteSign()
    {

        $sign = SignsList::find($this->signId);

        if ($sign) {
            $sign->delete();
            $this->isShowConfirmingSignDeletionModal = false;
            $this->banner('Подпись успешно удалена.');
        } else {
            $this->dangerBanner('Подпись не найдена. Удаление не возможно.');
        }
    }

    public function render()
    {
        $results = Auth::user()->signslists()->orderBy('created_at', 'desc')->get();
        return view('livewire.iul-signs-list-component', [
            'signsData' => $results,
        ]);
    }
}