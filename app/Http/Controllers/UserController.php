<?php

namespace App\Http\Controllers;

use App\Contracts\UserTokenModelInterface;
use App\Http\Resources\UserResource;
use App\Repository\UserRepository;
use App\Utils\ResponseUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    /** @var UserTokenModelInterface */
    private $userTokenRepository;

    /**
     * UserController constructor.
     * @param UserTokenModelInterface $userTokenRepository
     */
    public function __construct(UserTokenModelInterface $userTokenRepository)
    {
        $this->userTokenRepository = $userTokenRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getInfo(Request $request) {

        if (!$request->bearerToken()) {
            return ResponseUtils::errorResult('Токен не задан');
        }

        try {
            $user = $this->userTokenRepository::getUserInfoByToken($request->bearerToken());
            if (!$user) {
                return ResponseUtils::errorResult('Пользователь не найден');
            }
            return ResponseUtils::successUserResult(new UserResource($user));
        }
        catch (\Exception $exception) {
            Log::error('error', ['message' => $exception->getMessage()]);
            return ResponseUtils::errorResult($exception->getMessage());
        }

    }

}
