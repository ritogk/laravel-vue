<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// request
use App\Http\Requests\Master\UserRequest;
// usecase
use App\UseCases\Master\User\ListAction;
use App\UseCases\Master\User\CreateAction;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;

class UserController extends Controller
{
    /**
     * 会員 一覧取得
     *
     * @param  Request $request
     * @param  ListAction $action
     * @return JsonResponse
     */
    public function list(Request $request, ListAction $action): JsonResponse
    {
        $parameters = new OpenAPI\Model\QueryUserList($request->all());
        $result = $action(
            $parameters->getName(),
            $parameters->getEmail(),
            $parameters->getSelfPr(),
            $parameters->getTel()
        );
        return response()->json(
            OpenAPIUtility::dicstionariesToModelContainers(OpenAPI\Model\User::class, $result),
            Response::HTTP_OK
        );
    }

    /**
     * 会員 登録
     *
     * @param  UserRequest $request
     * @param  CreateAction $action
     * @return JsonResponse
     */
    public function create(UserRequest $request, CreateAction $action): JsonResponse
    {
        $requestBody = new OpenAPI\Model\RequestUser($request->all());
        $result = $action(
            $requestBody->getName(),
            $requestBody->getEmail(),
            $requestBody->getPassword(),
            $requestBody->getSelfPr(),
            $requestBody->getTel()
        );
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\User::class, $result),
            Response::HTTP_CREATED
        );
    }
}
