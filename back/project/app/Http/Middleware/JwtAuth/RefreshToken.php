<?php

namespace App\Http\Middleware\JwtAuth;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use JWTAuth;

use App\Libs\Consts;

class RefreshToken extends BaseMiddleware
{
    /**
     * アクセストークンの有効期限が切れた場合のリフレッシュ処理を行う。
     *
     * @param Request $request
     * @param Closure $next
     * @return void
     */
    public function handle(Request $request, Closure $next)
    {
        $newToken = null;
        try {
            $token = JWTAuth::parseToken();
            $token->authenticate();
        } catch (TokenExpiredException $e) {
            // Token expired: try refresh
            try {
                $newToken = $token->refresh();
            } catch (JWTException $e) {
                // Refresh failed (refresh expired)
            }
        } catch (JWTException $e) {
            // Invalid token
        }

        if ($newToken) {
            $request->headers->set('Authorization', 'Bearer ' . $newToken);
        }
        return $next($request);
    }
}
