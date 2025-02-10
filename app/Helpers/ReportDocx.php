<?php

namespace App\Helpers;

use Str;
use Barryvdh\DomPDF\Facade\Pdf;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\TablePosition;
use PhpOffice\PhpWord\Style\Language;

class ReportDocx
{

  public function reportGenerate($data)
  {
    // Создаем новый объект PhpWord
    $phpWord = new PhpWord();

    $phpWord->setDefaultFontName('Calibri');
    $phpWord->setDefaultFontSize(11);
    $phpWord->getSettings()->setHideGrammaticalErrors(true);
    $phpWord->getSettings()->setHideSpellingErrors(true);
    $phpWord->getSettings()->setThemeFontLang(new Language(Language::RU_RU));
    $phpWord->getSettings()->setAutoHyphenation(false);

    $section = $phpWord->addSection(); // Добавляем секцию

    // Добавляем таблицу
    $table1 = $section->addTable([
      'borderSize' => 1, // Размер границы таблицы
      'borderColor' => '000000', // Цвет границы в шестнадцатеричном формате (черный)+
      'cellMargin' => 100,
      // 'width' => 100,
    ]);

    $cellStyle = ['valign' => 'center', 'alignment' => Jc::CENTER];
    $fontStyle = ['bold' => false, 'alignment' => JcTable::CENTER];
    $pStyle = ['align' => TablePosition::XALIGN_CENTER];
    // $fontStyle = ['bold' => false, 'alignment' => JcTable::CENTER, 'allCaps' => false, 'name' => 'Arial'];

    $row1 = $table1->addRow();
    $row1->addCell(1600, $cellStyle)->addText('Номер<w:br/>п/п', $fontStyle, $pStyle);
    $row1->addCell(2600, $cellStyle)->addText('Обозначение<w:br/>документа', $fontStyle, $pStyle);
    $row1->addCell(4600, $cellStyle)->addText('Наименование документа', $fontStyle, $pStyle);
    $row1->addCell(3000, $cellStyle)->addText('Номер последнего<w:br/>изменения (версии)', $fontStyle, $pStyle);

    $row2 = $table1->addRow();
    $row2->addCell(1600, $cellStyle)->addText($data['orderNumber'], $fontStyle, $pStyle);
    $row2->addCell(2600, $cellStyle)->addText($data['documentDesignation'], $fontStyle, $pStyle);
    $row2->addCell(4600, $cellStyle)->addText($data['documentName'], $fontStyle, $pStyle);
    $row2->addCell(3000, $cellStyle)->addText($data['versionNumber'], $fontStyle, $pStyle);

    $row3 = $table1->addRow();
    $row3->addCell(4200, ['gridSpan' => 2])->addText($data['currentAlgorithm'], $fontStyle, $pStyle);
    $row3->addCell(7600, ['gridSpan' => 2])->addText($data['fileData'][0]['hash'], $fontStyle, $pStyle);

    $row4 = $table1->addRow();
    $row4->addCell(4200, ['gridSpan' => 2])->addText('Наименование файла', $fontStyle, $pStyle);
    $row4->addCell(4600)->addText('Дата и время последнего<w:br/>изменения файла', $fontStyle, $pStyle);
    $row4->addCell(3000)->addText('Размер файла, байт', $fontStyle, $pStyle);

    $row5 = $table1->addRow();
    $row5->addCell(4200, ['gridSpan' => 2])->addText($data['fileData'][0]['fileName'], $fontStyle, $pStyle);
    $row5->addCell(4600)->addText($data['fileData'][0]['formattedDate'], $fontStyle, $pStyle);
    $row5->addCell(3000)->addText($data['fileData'][0]['fileSize'], $fontStyle, $pStyle);


    //Вторая таблица
    $table2 = $section->addTable([
      'borderSize' => 1, // Размер границы таблицы
      'borderColor' => '000000', // Цвет границы в шестнадцатеричном формате (черный)+
      'cellMargin' => 100,
      // 'width' => 100,
    ]);

    $cellStyle = ['valign' => 'center', 'alignment' => Jc::CENTER];
    $fontStyle = ['bold' => false, 'alignment' => JcTable::CENTER];
    $pStyle = ['align' => TablePosition::XALIGN_CENTER];

    $row1 = $table2->addRow();
    $row1->addCell(2900, $cellStyle)->addText('Характер работы', $fontStyle, $pStyle);
    $row1->addCell(3000, $cellStyle)->addText('Фамилия', $fontStyle, $pStyle);
    $row1->addCell(2900, $cellStyle)->addText('Подпись', $fontStyle, $pStyle);
    $row1->addCell(3000, $cellStyle)->addText('Дата подписания', $fontStyle, $pStyle);


    foreach ($data['responsiblePersons'] as $item) {
      $row2 = $table2->addRow();
      $row2->addCell(2900, $cellStyle)->addText($item['kind'], $fontStyle, $pStyle);
      $row2->addCell(3000, $cellStyle)->addText($item['surname'], $fontStyle, $pStyle);
      $row2->addCell(2900, $cellStyle)->addText('', $fontStyle, $pStyle);
      $row2->addCell(3000, $cellStyle)->addText('', $fontStyle, $pStyle);
    }

    /* $text = $section->addText($data['documentName']);
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
    } */

    //Формирование имени файла
    $randomString = Str::random(9); // Генерация случайной строки длиной 15 символов

    $timestamp = time(); // Получение текущей временной метки
    $fileName = $randomString . '-' . $timestamp . '.' . 'docx'; // Формирование имени файла
    // Сохраняем файл в публичную директорию
    $filePath = public_path($fileName);
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filePath);
    return $filePath;



    // switch ($data['fileType']) {
    //   case 'docx':
    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //     $objWriter->save($filePath);
    //     return $filePath;

    //   case 'odt':
    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
    //     $objWriter->save($filePath);
    //     return $filePath;

    //   case 'html':
    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
    //     $objWriter->save($filePath);
    //     return $filePath;

    //   case 'pdf':
    //     // $htmlContent = '<h1>' . htmlspecialchars($data['documentName']) . '</h1>';
    //     // Сохраняем HTML в буфер
    //     ob_start(); // Начинаем каптуру выходных данных
    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
    //     $objWriter->save('php://output'); // Сохраняем в поток вывода
    //     $htmlContent = ob_get_clean(); // Получаем содержимое буфера и очищаем его

    //     // Теперь создаем PDF из полученного HTML
    //     $pdf = Pdf::loadHTML($htmlContent);
    //     $pdf->save($filePath);

    //     return $filePath;
    // }

  }
}