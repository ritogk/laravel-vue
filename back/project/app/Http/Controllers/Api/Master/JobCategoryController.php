<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
// request
use App\Http\Requests\Master\JobCategoryListRequest;
use App\Http\Requests\Master\JobCategoryRequest;
// usecase
use App\UseCases\Master\JobCategory\ListAction;
use App\UseCases\Master\JobCategory\CreateAction;
use App\UseCases\Master\JobCategory\UpdateAction;
use App\UseCases\Master\JobCategory\DeleteAction;
use App\UseCases\Master\JobCategory\FindAction;
use App\UseCases\Master\JobCategory\ExportAction;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;

class JobCategoryController  extends Controller
{
    /**
     * 職種 一覧取得
     *
     * @param  JobCategoryListRequest $request
     * @param  ListAction $action
     * @return JsonResponse
     */
    public function list(JobCategoryListRequest $request, ListAction $action): JsonResponse
    {
        $result = $action($request->name, $request->content);
        return response()->json(
            OpenAPIUtility::dicstionariesToModelContainers(OpenAPI\Model\JobCategory::class, $result),
            Response::HTTP_OK
        );
    }

    /**
     * 職種 登録
     *
     * @param JobCategoryRequest $request
     * @param CreateAction $action
     * @return JsonResponse
     */
    public function create(JobCategoryRequest $request, CreateAction $action): JsonResponse
    {
        $requestBody = new OpenAPI\Model\RequestJobCategory($request->all());
        $result = $action(
            $requestBody->getName(),
            $requestBody->getContent(),
            $requestBody->getImage(),
            $requestBody->getSortNo()
        );
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\JobCategory::class, $result),
            Response::HTTP_CREATED
        );
    }

    /**
     * 職種 更新
     *
     * @param  JobCategoryRequest $request
     * @param string $id
     * @param  UpdateAction $action
     * @return JsonResponse
     */
    public function update(JobCategoryRequest $request, string $id, UpdateAction $action): JsonResponse
    {
        $requestBody = new OpenAPI\Model\RequestJobCategory($request->all());
        $result = $action(
            $id,
            $requestBody->getName(),
            $requestBody->getContent(),
            $requestBody->getImage(),
            $requestBody->getSortNo()
        );
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\JobCategory::class, $result),
            Response::HTTP_OK
        );
    }

    /**
     * 職種 削除
     *
     * @param string $id
     * @param DeleteAction $action
     * @return JsonResponse
     */
    public function destroy(string $id, DeleteAction $action): JsonResponse
    {
        $result = $action($id);
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\JobCategory::class, $result),
            Response::HTTP_OK
        );
    }

    /**
     * 職種 一件取得
     *
     * @param string $id
     * @param  FindAction $action
     * @return JsonResponse
     */
    public function find(string $id, FindAction $action): JsonResponse
    {
        $result = $action($id);
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\JobCategory::class, $result),
            Response::HTTP_OK
        );
    }

    /**
     * 職種 excel取得
     *
     * @param ExportAction $action
     * @return BinaryFileResponse
     */
    public function excel(ExportAction $action): BinaryFileResponse
    {
        return $action();
    }
}
