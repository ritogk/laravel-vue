<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\UserListRequest;

// usecase
use App\UseCases\Master\User\ListAction;

class UserController extends Controller
{
    /**
     * 会員 一覧取得
     *
     * @param  UserListRequest $request
     * @param  ListAction $action
     * @return array
     */
    public function list(UserListRequest $request, ListAction $action): array
    {
        return $action($request->filter, $request->fields);
    }
}
