<?php

namespace App\Helpers;

class FileRemover
{
  public function fileRemove($filePath)
  {
    // Используем событие "terminating", чтобы удалить файл после ответа
    app()->terminating(function () use ($filePath) {
      if (file_exists($filePath)) {
        unlink($filePath); // Удаляем файл
      }
    });
  }
}