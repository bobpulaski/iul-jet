<?php

namespace App\Services;

use App\Helpers\ReportDocx;
use App\Helpers\ReportPdf;
use App\Helpers\FileRemover;
use Illuminate\Support\Facades\Auth;

class ReportService
{
  public function generateReport($data, $fileType)
  {
    switch ($fileType) {
      case 'docx':
        $reportGenerator = new ReportDocx();
        break;

      case 'pdf':
        $reportGenerator = new ReportPdf();
        break;

      case 'html':
        return $this->handleHtmlReport($data);

      default:
        throw new \InvalidArgumentException('Invalid file type');
    }

    $filePath = $reportGenerator->reportGenerate($data);
    return response()->download($filePath)->deleteFileAfterSend(true);
  }

  private function handleHtmlReport($data)
  {
    session(['reportData' => $data]);
    // Возвращаем флаг для обозначения необходимости редиректа
    return false;
  }
}