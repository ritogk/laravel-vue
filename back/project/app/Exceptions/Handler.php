<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * 認証エラー時
     *
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['errors' => ['general' => [$exception->getMessage()]]], 401);

        // ガードを見て処理を切り替える事も可能
        // // 管理画面
        // if (in_array('admin', $exception->guards())) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // // 一般画面
        // if (in_array('user', $exception->guards())) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
    }
}
