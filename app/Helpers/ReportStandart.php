<?php

namespace App\Helpers;

use Str;

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
    $fileName = $randomString . '-' . $timestamp . '.docx'; // Формирование имени файла

    // Сохраняем файл в публичную директорию
    $filePath = public_path($fileName);
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filePath);

    return $filePath;
  }
}