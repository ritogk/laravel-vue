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
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $newToken = '';
        $token = null;
        try {
            $token = JWTAuth::parseToken();
            $token->authenticate();
        } catch (TokenExpiredException $e) {
            if ($token != null) {
                // Token expired: try refresh
                try {
                    $newToken = $token->refresh();
                } catch (JWTException $e) {
                    // Refresh failed (refresh expired)
                }
            }
        } catch (JWTException $e) {
            // Invalid token
        }

        // アクセストークンの有効期限が切れていない場合は目的のAPIをそのまま実行
        if ($newToken == null) {
            return $next($request);
        }

        // リフレッシュしたトークンをAuthorizationヘッダーに付与して目的のAPIを実行
        if ($newToken !== '') {
            $request->headers->set('Authorization', 'Bearer ' . $newToken);
        }
        $response = $next($request);

        // リフレッシュしたトークンをset-cookieに入れてクライアント側に返す
        $cookie = null;
        $current_route_middlewares = $request->route()->computedMiddleware;
        if (in_array('auth:user', $current_route_middlewares)) {
            $cookie = cookie(Consts::coockie_nm_dict['USER_JWT'], $newToken, auth('user')->factory()->getTTL() * 60);
        } else if (in_array('auth:admin', $current_route_middlewares)) {
            $cookie = cookie(Consts::coockie_nm_dict['ADMIN_JWT'], $newToken, auth('admin')->factory()->getTTL() * 60);
        }
        $response->withCookie($cookie);
        return $response;
    }
}
