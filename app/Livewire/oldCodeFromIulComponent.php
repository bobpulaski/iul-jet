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




<!-- генерация отчетов (выделил в отдельный сервис) -->

// switch ($this->fileType) {
// case 'docx':
// $ReportDocx = new ReportDocx();
// $filePath = $ReportDocx->reportGenerate($data);

// $response = response()->download($filePath);

// $fileRemover = new FileRemover();
// $fileRemover->fileRemove($filePath);

// //Обновляем данные в таблице Settings
// $user = Auth::user();
// $settings = $user->settings;

// try {
// if (!$settings) {
// $settings = $user->settings()->create();
// } else {
// $settings->update([
// 'is_title' => $this->isTitle,
// 'is_footer' => $this->isFooter,
// 'file_type' => $this->fileType,
// 'algorithm' => $this->currentAlgorithm,
// 'header_type' => $this->headerType,
// ]);
// }
// } catch (\Exception $e) {
// dd($e->getMessage());
// }
// return $response;

// case 'html':
// //Обновляем данные в таблице Settings
// $user = Auth::user();
// $settings = $user->settings;

// try {
// if (!$settings) {
// $settings = $user->settings()->create();
// } else {
// $settings->update([
// 'is_title' => $this->isTitle,
// 'is_footer' => $this->isFooter,
// 'file_type' => $this->fileType,
// 'algorithm' => $this->currentAlgorithm,
// 'header_type' => $this->headerType,
// ]);
// }
// } catch (\Exception $e) {
// dd($e->getMessage());
// }

// session(['reportData' => $data]);
// $this->dispatch('redirectToReport');

// // Сохраняем в таблице History
// $historyData = [
// 'name' => $this->name,
// 'order_number' => $this->orderNumber,
// 'document_designation' => $this->documentDesignation,
// ];

// $user->histories()->create($historyData);
// break;


// case 'pdf':
// $ReportPdf = new ReportPdf();
// $filePath = $ReportPdf->reportGenerate($data);

// $response = response()->download($filePath);

// $fileRemover = new FileRemover();
// $fileRemover->fileRemove($filePath);

// //Обновляем данные в таблице Settings
// $user = Auth::user();
// $settings = $user->settings;

// try {
// if (!$settings) {
// $settings = $user->settings()->create();
// } else {
// $settings->update([
// 'is_title' => $this->isTitle,
// 'is_footer' => $this->isFooter,
// 'file_type' => $this->fileType,
// 'algorithm' => $this->currentAlgorithm,
// 'header_type' => $this->headerType,
// ]);
// }
// } catch (\Exception $e) {
// dd($e->getMessage());
// }
// return $response;
// }





// $user = Auth::user();
// $settings = $user->settings()->first();

// if (!$settings) {
// $settings = $user->settings()->create();
// $settings = $user->settings()->first();

// $this->settings = $settings;

// $this->isTitle = $this->settings->is_title;
// $this->isFooter = $this->settings->is_footer;
// $this->fileType = $this->settings->file_type;
// $this->currentAlgorithm = $this->settings->algorithm;
// $this->headerType = $this->settings->header_type;
// } else {
// $this->settings = $settings;

// $this->isTitle = $this->settings->is_title;
// $this->isFooter = $this->settings->is_footer;
// $this->fileType = $this->settings->file_type;
// $this->currentAlgorithm = $this->settings->algorithm;
// $this->headerType = $this->settings->header_type;
// }