<?php

namespace App\Http\Middleware\JwtAuth;

use Closure;
use Illuminate\Http\Request;
use App\Libs\Consts;

class AddAuthorizationHeader
{
    /**
     * jwt-authでマルチ認証を可能にするためのmiddleware
     * jwt-authはcoockieでマルチ認証を考慮して作らていないため、指定のクッキーを無理やり
     * coockieでjwtを送信しなければこのmiddlewareは不要だけどjwtはセキュリティ的な観点からhttponly属性のcoockieで管理したい。
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $jwt = '';
        $current_route_middlewares = $request->route()->computedMiddleware;
        if (in_array('auth:user', $current_route_middlewares)) {
            $jwt = $request->cookie(Consts::coockie_nm_dict['USER_JWT']);
        } else if (in_array('auth:admin', $current_route_middlewares)) {
            $jwt = $request->cookie(Consts::coockie_nm_dict['ADMIN_JWT']);
        }
        if ($jwt) {
            $request->headers->set('Authorization', 'Bearer ' . $jwt);
        }
        return $next($request);;
    }
}
