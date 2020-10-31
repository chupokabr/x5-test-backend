<?php

namespace App\Utils;

use App\Http\Resources\UserResource;

class ResponseUtils
{
    /**
     * @param string|null $error
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public static function errorResult(?string $error = '')
    {
        return response(['status' => false, 'error' => $error], 400);
    }

    /**
     * @param string|null $error
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public static function errorAuthorizationResult(?string $error)
    {
        return response(['status' => false, 'error' => $error], 401);
    }

    /**
     * @param string $token
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public static function successAuthorizationResult(string $token)
    {
        return response(['status' => true, 'token' => $token], 200);
    }

    /**
     * @param UserResource $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public static function successUserResult(UserResource $user)
    {
        return response(['status' => true, 'user' => $user], 200);
    }

}
