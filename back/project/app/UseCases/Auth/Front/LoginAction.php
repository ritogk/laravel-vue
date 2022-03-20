<?php

namespace App\UseCases\Auth\Front;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LoginAction
{

    /**
     * __invoke
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        if (!$token = auth('user')->attempt($request->all())) {
            return response()->json(['errors' => ['message' => ['認証に失敗しました。']]], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * トークン返却
     * トークンに関する情報を配列化してからJSON形式で返却する
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
