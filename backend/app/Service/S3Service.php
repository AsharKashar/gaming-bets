<?php


namespace App\Service;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Helpers\FileHelper;

/**
 * Class ImageUploader
 * @package App\Service
 */
class S3Service
{
    /**
     * @param $file
     * @param string|null $directory
     * @return string
     */
    public static function uploadToDirectory($file, string $directory = null): ?string
    {
        $imagePath = '';
        if ($directory) {
            $imagePath .= "$directory/";
        }
        $imagePath .= FileHelper::formatFileName($file, true);
        $image = Image::make($file);
        if (Storage::disk('s3')->put($imagePath, $image->stream())) {
            return $imagePath;
        }

        return null;
    }


    /**
     * @param string $directory
     * @param $file
     * @param string $id
     * @return string|null
     */
    public static function uploadFile(string $directory, $file, string $id): ?string
    {
        if (empty($id)) {
            $id = 'guest';
        }

        $filePath = "$directory/$id/" . time() . '.' . $file->getClientOriginalExtension();
        $content = file_get_contents($file);

        if (Storage::disk('s3')->put($filePath, $content)) {
            return $filePath;
        }

        return null;
    }
}
