<?php

namespace App\Livewire;

use App\Models\History;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Services\ReportService;
use Illuminate\Support\Facades\Crypt;
use Laravel\Jetstream\InteractsWithBanner;

class IulHistoryComponent extends Component
{
    use WithPagination;
    use InteractsWithBanner;


    //TODO Добавить функционал очистки всей истории


    //TODO Нужно сохранять последнее значение
    public $perPage = 10;
    public bool $confirmingHistoryDeletion = false;
    public bool $isShowConfirmingHistoryDisposalModal = false;

    public int $historyId;


    public function showConfirmingHistoryDisposalModal()
    {
        $this->isShowConfirmingHistoryDisposalModal = true;
    }

    public function clearAllHistory()
    {
        $this->isShowConfirmingHistoryDisposalModal = false;
        $user = Auth::user();
        History::where("user_id", $user->id)->delete();

        $this->banner('История очищена. Все записи удалены.');
    }

    public function confirmHistoryDeletion($id)
    {
        $this->confirmingHistoryDeletion = true;
        $this->historyId = $id / 52;
    }

    public function clearAll($id)
    {
        $this->confirmingHistoryDeletion = true;
        $this->historyId = $id / 52;
    }

    public function deleteHistory()
    {
        $history = History::find($this->historyId); // получаем запись по ID
        if ($history) {
            $history->delete();
            $this->confirmingHistoryDeletion = false;
            $this->banner('Запись успешно удалена.');
        } else {
            $this->dangerBanner('Запись не найдена. Удаление не возможно.');
        }
    }

    public function reportEdit($id)
    {
        return redirect()->route('dashboard', ['id' => $id]);
    }

    public function reportSave($id)
    {
        $results = History::find($id / 52)->toArray();

        $data = [
            'name' => $results['name'],
            'orderNumber' => $results['order_number'],
            'documentDesignation' => $results['document_designation'],
            'documentName' => $results['document_name'],
            'versionNumber' => $results['version_number'],

            'responsiblePersons' => json_decode($results['responsible_persons'], true),

            'fileData' => array(
                [
                    'hash' => $results["hash"],
                    'fileName' => $results["file_name"],
                    'formattedDate' => $results["formatted_date"],
                    'fileSize' => $results["file_size"],
                ]
            ),

            'algorithm' => $results['algorithm'],

            'description' => $results['description'],
            'page' => $results['page'],
            'pages' => $results['pages'],

            'isTitle' => $results['is_title'],
            'headerType' => $results['header_type'],
            'isFooter' => $results['is_footer'],
        ];

        $reportService = new ReportService();
        $result = $reportService->generateReport($data, $results["file_type"]);

        if (is_bool($result) && $result === false) {
            // Если это HTML, вызываем событие на frontend для открытия новой вкладки
            $this->dispatch('redirectToReport');
            $this->banner('Отчет успешно сохранён.');
        } else {
            // Если это не HTML, то возвращаем результат, например, для загрузки
            $this->banner('Отчет успешно сохранён.');
            return $result; // это будет response()->download($filePath);
        }


    }

    public function render()
    {
        $results = Auth::user()->histories()
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.iul-history-component', [
            'historyData' => $results,
        ]);
    }
}