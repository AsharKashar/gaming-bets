<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse as JsonResponseAlias;
use Illuminate\Http\Request;
use App\Service\S3Service;
use Log;


/**
 * Class UploadController
 * @package App\Admin\Controllers
 */
class UploadController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponseAlias
     */
    public function uploadFileToS3(Request $request)
    {
        if (!$request->hasFile('file')) {
            return $this->resourceNotFound();
        }

        try {
            $path = S3Service::uploadToDirectory($request->file('file'),$request->input('directory'));
            return response()->json(['location'=> config('filesystems.disks.s3.url') . $path]);
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            return $this->internalErrorApiResponse([$e->getMessage()]);
        }
    }
}
