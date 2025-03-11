<?php

namespace App\Helpers;

use Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Debugbar\Facades\Debugbar;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\TablePosition;
use PhpOffice\PhpWord\Style\Language;
use DateTime;

class ReportPdf
{

  public function reportGenerate($data)
  {

    Debugbar::error($data);

    $randomString = Str::random(9); // Генерация случайной строки длиной 15 символов

    $timestamp = time(); // Получение текущей временной метки
    $fileName = $randomString . '-' . $timestamp . '.' . 'pdf'; // Формирование имени файла
    // Сохраняем файл в публичную директорию
    $filePath = public_path($fileName);


    $pdf = Pdf::loadView('iulpdf', $data);
    $pdf->save($filePath);
    return $filePath;

  }
}
