<?php

namespace App\Helpers;

use Str;

class ReportStandart
{

  public function reportGenerate($name)
  {
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();
    $text = $section->addText($name);

    $randomString = Str::random(15); // Генерация случайной строки длиной 15 символов
    $timestamp = time(); // Получение текущей временной метки
    $fileName = $randomString . '-' . $timestamp . '.docx'; // Формирование имени файла

    // Сохраняем файл в публичную директорию
    $filePath = public_path($fileName);
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filePath);

    return $filePath;
  }
}