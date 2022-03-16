<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use \Cookie;
// request
use App\Http\Requests\Auth\Admin\LoginRequest;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;

class AuthAdminController extends Controller
{
    /**
     * login
     *
     * @param  LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $requestBody = new OpenAPI\Model\RequestLogin($request->all());
        $request_all = ['email' => $requestBody->getEmail(), 'password' => $requestBody->getPassword()];
        if (!$token = auth('admin')->attempt($request_all)) {
            return response()->json(
                ['error' => 'Unauthorized'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $result = $this->respondWithToken($token);
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\AccessToken::class, $result),
            Response::HTTP_CREATED
        );
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\Admin::class, auth('admin')->user()->toArray()),
            Response::HTTP_OK
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth('admin')->logout();
        return response()->json(
            ['message' => 'Successfully logged out'],
            Response::HTTP_NO_CONTENT
        )->cookie(Cookie::forget('token'));
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $result = $this->respondWithToken(auth('admin')->refresh());
        return response()->json(
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\AccessToken::class, $result),
            Response::HTTP_CREATED
        );
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return array
     */
    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ];
    }
}
