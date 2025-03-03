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


    public function getChecksumCrc32($filePath)
    {
        $hash = hash_file('crc32b', $filePath);
        return $hash;
    }

    public function getChecksumMd5($filePath)
    {
        $hash = md5_file($filePath, false);
        return $hash;
    }

    public function getChecksumSha1($filePath)
    {
        $hash = sha1_file($filePath);
        return $hash;
    }


}
