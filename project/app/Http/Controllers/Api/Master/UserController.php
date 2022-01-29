<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
// request
use App\Http\Requests\Master\UserListRequest;
// usecase
use App\UseCases\Master\User\ListAction;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;

class UserController extends Controller
{
    /**
     * 会員 一覧取得
     *
     * @param  UserListRequest $request
     * @param  ListAction $action
     * @return JsonResponse
     */
    public function list(UserListRequest $request, ListAction $action): JsonResponse
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
}
