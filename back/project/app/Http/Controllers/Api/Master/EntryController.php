<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
// request
use App\Http\Requests\Master\EntryListRequest;
use App\Http\Requests\Master\EntryRequest;
// usecase
use App\UseCases\Master\Entry\ListAction;
use App\UseCases\Master\Entry\CreateAction;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;

class EntryController extends Controller
{
    /**
     * 求人申込 一覧取得
     *
     * @param  EntryListRequest $request
     * @param  ListAction $action
     * @return JsonResponse
     */
    public function list(EntryListRequest $request, ListAction $action): JsonResponse
    {
        $result = $action($request->jobId, $request->userId);
        return response()->json(
            OpenAPIUtility::dicstionariesToModelContainers(OpenAPI\Model\Entry::class, $result),
            Response::HTTP_OK
        );
    }

    /**
     * 求人申込 登録
     *
     * @param EntryRequest $request
     * @param CreateAction $action
     * @return JsonResponse
     */
    public function create(EntryRequest $request, CreateAction $action): JsonResponse
    {
        $requestBody = new OpenAPI\Model\RequestEntry($request->all());
        $result = $action($requestBody->getUserId(), $requestBody->getJobId());
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\Entry::class, $result),
            Response::HTTP_CREATED
        );

        return $action($request);
    }
}
