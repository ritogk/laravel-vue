<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// request
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
     * @param  Request $request
     * @param  ListAction $action
     * @return JsonResponse
     */
    public function list(Request $request, ListAction $action): JsonResponse
    {
        $parameters = new OpenAPI\Model\QueryEntryList($request->all());
        $result = $action($parameters->getJobId(), $parameters->getJobCategoryId(), $parameters->getUserName(), $parameters->getSelfPr());

        return response()->json(
            OpenAPIUtility::dicstionariesToModelContainers(OpenAPI\Model\ResponseJobEntry::class, $result),
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
        $result = $action($requestBody->getJobId(), $requestBody->getUserId());
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\Entry::class, $result),
            Response::HTTP_CREATED
        );

        return $action($request);
    }
}
