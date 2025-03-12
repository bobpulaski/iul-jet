<?php

namespace App\Livewire;

use App\Models\History;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Services\ReportService;
use Illuminate\Support\Facades\Crypt;

class IulHistoryComponent extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function mount(
    ) {

    }

    public function reportEdit($id)
    {
        return redirect()->route('dashboard', ['id' => $id]);
    }

    public function reportSave($id)
    {
        $results = History::find($id)->toArray();

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
        } else {
            // Если это не HTML, то возвращаем результат, например, для загрузки
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
