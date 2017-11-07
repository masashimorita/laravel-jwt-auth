<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class authJWT extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
//        try {
////            $user = JWTAuth::toUser($request->input('token'));
//            $user = JWTAuth::toUser(JWTAuth::getToken());
//        } catch(Exception $e) {
//            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
//                return response()->json(['error' => 'Token is Invalid']);
//            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
//                $newToken = JWTAuth::refresh(JWTAuth::getToken());
//                return response()->json(['newToken' => $newToken]);
////                return response()->json(['error' => 'Token is Expired']);
//            } else {
//                return response()->json(['error' => 'Something is wrong']);
//            }
//        }

        try {
            $user = JWTAuth::authenticate(JWTAuth::getToken());
        }catch(Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                $newToken = JWTAuth::refresh(JWTAuth::getToken());
                JWTAuth::setToken($newToken);
                $response = $next($request);
                if ( ! $response instanceof SymfonyResponse) {
                    $response = new Response($response);
                }

                $response->headers->set('newToken', $newToken);
                return $response;
            }
        }

        return $next($request);
    }
}