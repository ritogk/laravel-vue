<?php

namespace App\Http\Controllers\Api;

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
        $parameters = new OpenAPI\Model\RequestFile($request->all());
        $result = $action(
            $parameters->getFile()
        );
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\File::class, $result),
            Response::HTTP_CREATED
        );
    }
}
