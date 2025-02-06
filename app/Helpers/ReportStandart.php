<?php

namespace App\Helpers;

use Str;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportStandart
{

  public function reportGenerate($data)
  {
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();

    $text = $section->addText($data['documentName']);
    $text = $section->addText($data['currentAlgorithm']);

    foreach ($data['fileData'] as $item) {
      // Проверяем, является ли элемент массивом
      if (is_array($item)) {
        foreach ($item as $subItem) {
          // Теперь $subItem - это значение из вложенного массива
          $section->addText($subItem); // Здесь добавляем текст
        }
      } else {
        // Если $item не массив, просто добавляем текст
        $section->addText($item);
      }
    }


    foreach ($data['responsiblePersons'] as $item) {
      // Проверяем, является ли элемент массивом
      if (is_array($item)) {
        foreach ($item as $subItem) {
          // Теперь $subItem - это значение из вложенного массива
          $section->addText($subItem); // Здесь добавляем текст
        }
      } else {
        // Если $item не массив, просто добавляем текст
        $section->addText($item);
      }
    }

    //Формирование имени файла
    $randomString = Str::random(15); // Генерация случайной строки длиной 15 символов
    $timestamp = time(); // Получение текущей временной метки


    $fileName = $randomString . '-' . $timestamp . '.' . $data['fileType']; // Формирование имени файла

    // Сохраняем файл в публичную директорию
    $filePath = public_path($fileName);

    switch ($data['fileType']) {
      case 'docx':
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filePath);
        return $filePath;

      case 'odt':
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
        $objWriter->save($filePath);
        return $filePath;

      case 'html':
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        $objWriter->save($filePath);
        return $filePath;

      case 'pdf':
        // $htmlContent = '<h1>' . htmlspecialchars($data['documentName']) . '</h1>';
        // Сохраняем HTML в буфер
        ob_start(); // Начинаем каптуру выходных данных
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        $objWriter->save('php://output'); // Сохраняем в поток вывода
        $htmlContent = ob_get_clean(); // Получаем содержимое буфера и очищаем его

        // Теперь создаем PDF из полученного HTML
        $pdf = Pdf::loadHTML($htmlContent);
        $pdf->save($filePath);

        return $filePath;
    }

  }
}