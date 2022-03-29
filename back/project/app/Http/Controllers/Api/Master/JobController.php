<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
// request
use App\Http\Requests\Master\JobRequest;
// usecase
use App\UseCases\Master\Job\ListAction;
use App\UseCases\Master\Job\CreateAction;
use App\UseCases\Master\Job\UpdateAction;
use App\UseCases\Master\Job\DeleteAction;
use App\UseCases\Master\Job\FindAction;
use App\UseCases\Master\Job\ExportAction;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;


class JobController extends Controller
{
    /**
     * 仕事 一覧取得
     *
     * @param  Request $request
     * @param  ListAction $action
     * @return JsonResponse
     */
    public function list(Request $request, ListAction $action): JsonResponse
    {
        $parameters = new OpenAPI\Model\QueryJobList($request->all());
        $result = $action(
            $parameters->getTitle(),
            $parameters->getContent(),
            OpenAPIUtility::castBoolean($parameters->getAttention()),
            $parameters->getJobCategoryId(),
            $parameters->getPrice(),
            $parameters->getWelfare(),
            $parameters->getHoliday()
        );
        return response()->json(
            OpenAPIUtility::dicstionariesToModelContainers(OpenAPI\Model\Job::class, $result),
            Response::HTTP_OK
        );
    }

    /**
     * 仕事 登録
     *
     * @param JobRequest $request
     * @param CreateAction $action
     * @return JsonResponse
     */
    public function create(JobRequest $request, CreateAction $action): JsonResponse
    {
        $requestBody = new OpenAPI\Model\RequestJob($request->all());
        $result = $action(
            $requestBody->getTitle(),
            $requestBody->getContent(),
            $requestBody->getAttention(),
            $requestBody->getJobCategoryId(),
            $requestBody->getPrice(),
            $requestBody->getWelfare(),
            $requestBody->getHoliday(),
            $requestBody->getImage(),
            $requestBody->getSortNo()
        );
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\Job::class, $result),
            Response::HTTP_CREATED
        );
    }

    /**
     * 仕事 更新
     *
     * @param  JobRequest $request
     * @param string $id
     * @param  UpdateAction $action
     * @return JsonResponse
     */
    public function update(JobRequest $request, string $id, UpdateAction $action): JsonResponse
    {
        $requestBody = new OpenAPI\Model\RequestJob($request->all());
        $result = $action(
            $id,
            $requestBody->getTitle(),
            $requestBody->getContent(),
            $requestBody->getAttention(),
            $requestBody->getJobCategoryId(),
            $requestBody->getPrice(),
            $requestBody->getWelfare(),
            $requestBody->getHoliday(),
            $requestBody->getImage(),
            $requestBody->getSortNo()
        );
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\Job::class, $result),
            Response::HTTP_OK
        );
    }

    /**
     * 仕事 削除
     *
     * @param string $id
     * @param DeleteAction $action
     * @return JsonResponse
     */
    public function destroy(string $id, DeleteAction $action): JsonResponse
    {
        $result = $action($id);
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\Job::class, $result),
            Response::HTTP_OK
        );
    }

    /**
     * 仕事 一件取得
     *
     * @param string $id
     * @param  FindAction $action
     * @return JsonResponse
     */
    public function find(String $id, FindAction $action): JsonResponse
    {
        $result = $action($id);
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\Job::class, $result),
            Response::HTTP_OK
        );
    }

    /**
     * 仕事 excel取得
     *
     * @param ExportAction $action
     * @return BinaryFileResponse
     */
    public function excel(ExportAction $action): BinaryFileResponse
    {
        return $action();
    }
}
