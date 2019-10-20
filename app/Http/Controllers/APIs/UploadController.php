<?php

namespace App\Http\Controllers\APIs;

use App\Constants\AppConstant;
use App\Constants\StatusCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Upload\UploadService;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    /**
     * @var UploadService
     */
    private $uploadService;

    /**
     * UploadController constructor.
     *
     * @param UploadService $uploadService
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images.*' => 'required|image|mimes:' . AppConstant::MIME_TYPE_IMAGE . '|max:' . AppConstant::IMAGE_MAXSIZE,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'     => StatusCode::UNPROCESSABLE_ENTITY,
                'message' => $validator->errors()->first(),
            ]);
        }

        $images = $this->uploadService->uploadImageTemp($request->file('images'));

        if (!empty($images)) {
            return response()->json([
                'code' => StatusCode::OK,
                'data' => [
                    'images' => $images,
                ],
            ]);
        }

        return response()->json([
            'code'     => StatusCode::BAD_REQUEST,
            'messages' => 'Upload fails!',
        ]);
    }
}
