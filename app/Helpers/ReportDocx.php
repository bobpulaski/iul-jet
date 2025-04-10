<?php

namespace App\Helpers;

use Str;
use Barryvdh\DomPDF\Facade\Pdf;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\TablePosition;
use PhpOffice\PhpWord\Style\Language;
use DateTime;

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

    $section->addText('Информационно-удостоверяющий лист', array('size' => 16));

    // Добавляем таблицу
    $table1 = $section->addTable([
      'borderSize' => 6, // Размер границы таблицы
      'borderColor' => '000000', // Цвет границы в шестнадцатеричном формате (черный)+
      'cellMargin' => 100,
      // 'width' => 100,
    ]);

    switch ($data['headerType']) {
      case 'regular':
        $headerFontStyle = ['bold' => false, 'alignment' => JcTable::CENTER];
        break;
      case 'bold':
        $headerFontStyle = ['bold' => true, 'alignment' => JcTable::CENTER];
        break;
      case 'italic':
        $headerFontStyle = ['bold' => false, 'italic' => true, 'alignment' => JcTable::CENTER];
        break;
      case 'italic-bold':
        $headerFontStyle = ['bold' => true, 'italic' => true, 'alignment' => JcTable::CENTER];
        break;
    }

    $cellStyle = ['valign' => 'center', 'alignment' => Jc::CENTER];
    $pStyle = ['align' => TablePosition::XALIGN_CENTER];
    $fontStyle = ['bold' => false, 'alignment' => JcTable::CENTER, 'allCaps' => false];

    if ($data['isTitle']) {
      $row1 = $table1->addRow();
      $row1->addCell(4200, ['gridSpan' => 2])->addText('Наименование объекта', $headerFontStyle, $pStyle);
      $row1->addCell(7600, ['gridSpan' => 2])->addText($data['name'], $fontStyle, $pStyle);
    }


    $row2 = $table1->addRow();
    $row2->addCell(1600, $cellStyle)->addText('Номер<w:br/>п/п', $headerFontStyle, $pStyle);
    $row2->addCell(2600, $cellStyle)->addText('Обозначение<w:br/>документа', $headerFontStyle, $pStyle);
    $row2->addCell(4600, $cellStyle)->addText('Наименование документа', $headerFontStyle, $pStyle);
    $row2->addCell(3000, $cellStyle)->addText('Номер последнего<w:br/>изменения (версии)', $headerFontStyle, $pStyle);

    $row3 = $table1->addRow();
    $row3->addCell(1600, $cellStyle)->addText($data['orderNumber'], $fontStyle, $pStyle);
    $row3->addCell(2600, $cellStyle)->addText($data['documentDesignation'], $fontStyle, $pStyle);
    $row3->addCell(4600, $cellStyle)->addText($data['documentName'], $fontStyle, $pStyle);
    $row3->addCell(3000, $cellStyle)->addText($data['versionNumber'], $fontStyle, $pStyle);

    $row4 = $table1->addRow();
    $row4->addCell(4200, ['gridSpan' => 2])->addText($data['algorithm'], $headerFontStyle, $pStyle);
    $row4->addCell(7600, ['gridSpan' => 2])->addText($data['fileData'][0]['hash'], $fontStyle, $pStyle);

    $row5 = $table1->addRow();
    $row5->addCell(4200, ['gridSpan' => 2])->addText('Наименование файла', $headerFontStyle, $pStyle);
    $row5->addCell(4600)->addText('Дата и время последнего<w:br/>изменения файла', $headerFontStyle, $pStyle);
    $row5->addCell(3000)->addText('Размер файла, байт', $headerFontStyle, $pStyle);

    $row6 = $table1->addRow();
    $row6->addCell(4200, ['gridSpan' => 2])->addText($data['fileData'][0]['fileName'], $fontStyle, $pStyle);
    $row6->addCell(4600)->addText($data['fileData'][0]['formattedDate'], $fontStyle, $pStyle);
    $row6->addCell(3000)->addText($data['fileData'][0]['fileSize'], $fontStyle, $pStyle);


    //Вторая таблица
    $table2 = $section->addTable([
      'borderSize' => 6, // Размер границы таблицы
      'borderColor' => '000000', // Цвет границы в шестнадцатеричном формате (черный)+
      'cellMargin' => 100,
      // 'width' => 100,
    ]);

    $row1 = $table2->addRow();
    $row1->addCell(2900, $cellStyle)->addText('Характер работы', $headerFontStyle, $pStyle);
    $row1->addCell(3000, $cellStyle)->addText('Фамилия', $headerFontStyle, $pStyle);
    $row1->addCell(2900, $cellStyle)->addText('Подпись', $headerFontStyle, $pStyle);
    $row1->addCell(3000, $cellStyle)->addText('Дата подписания', $headerFontStyle, $pStyle);




    if ($data['responsiblePersons'] === []) {
      $row2 = $table2->addRow();
      $row2->addCell(2900, $cellStyle)->addText('', $fontStyle, $pStyle);
      $row2->addCell(3000, $cellStyle)->addText('', $fontStyle, $pStyle);
      $row2->addCell(2900, $cellStyle)->addText('', $fontStyle, $pStyle);
      $row2->addCell(3000, $cellStyle)->addText('', $fontStyle, $pStyle);
    } else {
      foreach ($data['responsiblePersons'] as $item) {

        if ($item['signdate'] === null) { // Используем оператор сравнения
          $signFormattedDate = '';
        } else {
          $signFormattedDate = $item['signdate'];
          // Форматируем дату YYYY-MM-DD
          $date = $signFormattedDate; // Пример даты в формате YYYY-MM-DD
          $dateTime = new DateTime($date);
          $signFormattedDate = $dateTime->format('d.m.Y'); // Форматируем дату в DD.MM.YYYY
        }

        $row2 = $table2->addRow();
        $row2->addCell(2900, $cellStyle)->addText($item['kind'], $fontStyle, $pStyle);
        $row2->addCell(3000, $cellStyle)->addText($item['surname'], $fontStyle, $pStyle);
        $row2->addCell(2900, $cellStyle)->addText('', $fontStyle, $pStyle);
        $row2->addCell(3000, $cellStyle)->addText($signFormattedDate, $fontStyle, $pStyle);
      }
    }


    //Подвал


    if ($data['isFooter']) {
      $table3 = $section->addTable([
        'borderSize' => 6, // Размер границы таблицы
        'borderColor' => '000000', // Цвет границы в шестнадцатеричном формате (черный)+
        'cellMargin' => 100,
        // 'width' => 100,
      ]);

      $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'alignment' => Jc::CENTER);
      $cellRowContinue = array('vMerge' => 'continue', 'valign' => 'center', 'alignment' => Jc::CENTER);

      $row1 = $table3->addRow();
      $row1->addCell(4200, $cellRowSpan)->addText("Информационно-удостоверяющий лист", $headerFontStyle, $pStyle);
      $row1->addCell(4600, $cellRowSpan)->addText($data['description'], $fontStyle, $pStyle);
      $row1->addCell(1500)->addText("лист", $headerFontStyle, $pStyle);
      $row1->addCell(1500)->addText("листов", $headerFontStyle, $pStyle);

      $row2 = $table3->addRow();
      $row2->addCell(null, $cellRowContinue);
      $row2->addCell(null, $cellRowContinue);
      $row2->addCell(1500)->addText($data['page'], $fontStyle, $pStyle);
      $row2->addCell(1500)->addText($data['pages'], $fontStyle, $pStyle);
    }





    // dd($data['responsiblePersons']);



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