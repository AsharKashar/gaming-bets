<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Traits\Payment;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(title="Banger Games API", version="1.0.0")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Payment;

    public function uploadFile($field_name, $storagePath)
    {
        $name = time().'.'.request()->{$field_name}->getClientOriginalExtension();
        request()->{$field_name}->move(storage_path('app/public/'.$storagePath), $name);
        return $storagePath.$name;
    }

    public function validate($data, $rules)
    {
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            Response::json(
                [
                    'status' => 'error',
                    'messages' => $validator->errors()
                ],
                400
            )->throwResponse();
        }

        return true;
    }

    /**
     * @param $url
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectApiResponse($url, $code = 301)
    {
        $responseData = [
            'status' => 'redirect',
            'url' => $url
        ];

        return response()->json($responseData, $code);
    }

    /**
     * @param  array  $data
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successApiResponse($data = [], $code = 200)
    {
        $responseData = [
            'status' => 'success',
            'data' => $data
        ];

        return response()->json($responseData, $code);
    }

    /**
     * @param  null  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function resourceNotFound($message = null, $code = 404)
    {
        if (!$message) {
            $message = 'Resource not found';
        }

        $responseData = [
            'status' => 'error',
            'message' => $message,
        ];

        return response()->json($responseData, $code);
    }

    /**
     * @param  array  $errors
     * @param  null  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function internalErrorApiResponse($errors = [], $message = null, $code = 500)
    {
        if (!$message) {
            $message = "Internal api error";
        }

        $responseData = [
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ];

        return response()->json($responseData, $code);
    }
}
