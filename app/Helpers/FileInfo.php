<?php

namespace App\Helpers;

class FileInfo
{
    public function getFileName($inputFile)
    {
        $fileName = $inputFile->getClientOriginalName();
        return $fileName;
    }

    public function getFileSize($inputFile)
    {
        $fileSize = $inputFile->getSize();
        return $fileSize;
    }

    public function getFileModifiedDateTime($filePath)
    {
        $fileModifiedTime = filemtime($filePath);
        return $fileModifiedTime;
    }

    public function getChecksumCrc32($filePath)
    {
        $hash = hash_file('crc32b', $filePath);
        return $hash;
    }


}
