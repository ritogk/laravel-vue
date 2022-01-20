<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\JobCategoryListRequest;
use App\Http\Requests\Master\JobCategoryRequest;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
     * @return OpenAPI\Model\JobCategory[]
     */
    public function index(JobCategoryListRequest $request, ListAction $action): array
    {
        $queryParameters = new OpenAPI\Model\QueryJobCategoryList($request->all());
        $result = $action($queryParameters->getName(), $queryParameters->getContent());
        return OpenAPIUtility::dicstionariesToModelContainers(OpenAPI\Model\JobCategory::class, $result);
    }

    /**
     * 職種 登録
     *
     * @param JobCategoryRequest $request
     * @param CreateAction $action
     * @return array
     */
    public function create(JobCategoryRequest $request, CreateAction $action): array
    {
        return $action($request);
    }

    /**
     * 職種 更新
     *
     * @param  JobCategoryRequest $request
     * @param string $id
     * @param  UpdateAction $action
     * @return void
     */
    public function update(JobCategoryRequest $request, string $id, UpdateAction $action): void
    {
        $action($id, $request);
    }

    /**
     * 職種 削除
     *
     * @param string $id
     * @param DeleteAction $action
     * @return void
     */
    public function destroy(string $id, DeleteAction $action)
    {
        $action($id);
    }

    /**
     * 職種 一件取得
     *
     * @param string $id
     * @param  FindAction $action
     * @return array
     */
    public function find(string $id, FindAction $action): array
    {
        return $action($id);
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
