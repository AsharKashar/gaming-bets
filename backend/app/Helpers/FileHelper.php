<?php

namespace App\Helpers;

class FileHelper
{
    /**
     * @param $file
     * @return string
     * @return boolean
     */
    public static function formatFileName($file, $appendDateSubfolders = false)
    {
        if ($file && !is_string($file)) {
            $extencion = $file->extension();
            $hashedName = md5($file->getClientOriginalName());
            $salt = time();
            $result = "$hashedName-$salt.$extencion";

            if ($appendDateSubfolders) {
                $year = date('Y');
                $month = date('n');

                $result = "$year/$month/$result";
            }

            return $result;
        }

        return '';
    }
}
