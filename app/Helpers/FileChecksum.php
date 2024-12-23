<?php

namespace App\Helpers;

class FileChecksum
{
    public function getChecksumCrc32($filePath)
    {
        $hash = hash_file('crc32b', $filePath);
        return $hash;
    }
}
