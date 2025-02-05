// public function phpinfo()
// {
// $reportStandart = new ReportStandart();
// $filePath = $reportStandart->reportGenerate('ss');

// $response = response()->download($filePath);

// $fileRemover = new FileRemover();
// $fileRemover->fileRemove($filePath);

// return $response;
// }


// public function uploadFile()
// {
// $fileInfo = new FileInfo();

// // Получаем информацию о файле
// $fileName = $fileInfo->getFileName($this->inputFile);
// $fileSize = $fileInfo->getFileSize($this->inputFile);

// // Сохраняем файл и вычисляем его хэш
// $this->saveFile($fileName);
// $filePath = storage_path('app/private/uploads/' . $fileName);

// $hashCrc32 = $fileInfo->getChecksumCrc32($filePath);
// $hashMd5 = $fileInfo->getChecksumMd5($filePath);
// $hashSha1 = $fileInfo->getChecksumSha1($filePath);

// // Выводим информацию о файле
// $this->outputFileInfo($fileName, $fileSize, $hashCrc32, $hashMd5, $hashSha1);
// }

// protected function saveFile($fileName)
// {
// $this->inputFile->storeAs('uploads', $fileName, 'local');
// }

// protected function outputFileInfo($fileName, $fileSize, $hashCrc32, $hashMd5, $hashSha1)
// {
// dd([
// 'name' => $this->name,
// 'orderNumber' => $this->orderNumber,
// 'documentDesignation' => $this->documentDesignation,
// 'documentName' => $this->documentName,
// 'versionNumber' => $this->versionNumber,
// 'responsiblePersons' => $this->responsiblePersons,
// 'currentAlgorithm' => $this->currentAlgorithm,
// 'rememberResponsiblePersons' => $this->rememberResponsiblePersons,

// 'fileName' => $fileName,
// 'fileSize' => $fileSize,
// 'fileModifiedDate' => $this->formattedDate,
// 'fileChecksumCrc32' => $hashCrc32,
// 'fileChecksumMd5' => $hashMd5,
// 'fileChecksumSha1' => $hashSha1,
// ]);
// }