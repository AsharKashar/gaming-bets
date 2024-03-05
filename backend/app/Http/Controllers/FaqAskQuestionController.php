<?php

namespace App\Http\Controllers;

use App\Service\S3Service;
use App\Model\FaqAskQuestion;
use Illuminate\Http\Request;

class FaqAskQuestionController extends Controller
{
    //
    /**
     * @OA\Post(
     *     path="/api/FAQ/ask-question",
     *     tags={"FAQ"},
     * @OA\Parameter(
     *     name="username",
     *     in="query",
     *     description="Username of the user",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="Email ID",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="description",
     *     in="query",
     *     description="Question description",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="file",
     *     in="query",
     *     description="Starting Date in timestamp format Y-m-d",
     * ),
     *     @OA\Response(response="200", description="Ask a question in FAQ section.")
     * )
     */
    public function addQuestions(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'username' => ['required'],
                'email' => ['required', 'email'],
                'description' => ['required'],
            ]
        );
        $question = new FaqAskQuestion();
        $question->username = $request->username;
        $question->email = $request->email;
        $question->description = $request->description;
        if ($request->file) {
            if (in_array(
                $request->file->getClientMimeType(),
                [
                    'image/jpeg',
                    'image/png',
                ]
            )) {
                if ($path = S3Service::uploadFile('FAQ', $request->file, "guest")) {
                    $prefix = config('services.awsurl.url');
                    $question->file_url = $prefix.$path;
                }
            } else {
                return response()->json(
                    [
                        'message' => 'Invalid file type. Only .png and .jpeg allowed'
                    ],
                    400
                );
            }
        }
        $question->save();
        return response()->json(
            [
                'status' => 'success',
                'result' => 'true',
                'message' => 'Question Submitted'
            ]
        );
    }
}
