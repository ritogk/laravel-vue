<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
// request
use App\Http\Requests\File\UploadRequest;
// usecase
use App\UseCases\File\UploadAction;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;

class FileController extends Controller
{
    /**
     * ファイル アップロード
     *
     * @param  UploadRequest $request
     * @param  UploadAction $action
     * @return JsonResponse
     */
    public function upload(UploadRequest $request, UploadAction $action): JsonResponse
    {
        $requestBody = new OpenAPI\Model\RequestFile($request->all());
        $result = $action(
            $requestBody->getFile()
        );
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\FilePath::class, $result),
            Response::HTTP_CREATED
        );
    }
}
