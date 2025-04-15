<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LoggerService
{
  /**
   * Записывает сообщение в лог-файл.
   *
   * @param string $message
   * @return void
   */
  public function logMessage(string $message)
  {
    Log::info($message);
  }
}
