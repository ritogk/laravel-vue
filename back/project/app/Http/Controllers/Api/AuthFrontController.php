<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
// request
use App\Http\Requests\Auth\Front\LoginRequest;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;

class AuthFrontController extends Controller
{
    /**
     * login
     *
     * @param  LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $parameters = new OpenAPI\Model\RequestLogin($request->all());
        $request_all = ['email' => $parameters->getEmail(), 'password' => $parameters->getPassword()];
        if (!$token = auth('user')->attempt($request_all)) {
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
            OpenAPIUtility::dicstionaryToModelContainer(OpenAPI\Model\User::class, auth('user')->user()->toArray()),
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
        auth('user')->logout();

        return response()->json(
            ['message' => 'Successfully logged out'],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $result = $this->respondWithToken(auth('user')->refresh());
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
            'expires_in' => auth('user')->factory()->getTTL() * 60
        ];
    }
}
