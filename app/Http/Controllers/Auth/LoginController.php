<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\UserTokenModelInterface;
use App\Http\Controllers\Controller;
use App\Utils\ResponseUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /** @var UserTokenModelInterface */
    private $userTokenRepository;

    public function __construct(UserTokenModelInterface $userTokenRepository)
    {
        $this->userTokenRepository = $userTokenRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                if (!$token = $this->userTokenRepository::generateUserToken(Auth::id())) {
                    return ResponseUtils::errorResult();
                }

                return ResponseUtils::successAuthorizationResult($token->token);
            }
        } catch (\Exception $exception) {
            return ResponseUtils::errorResult($exception->getMessage());
        }

        return ResponseUtils::errorResult('Неверные данные');
    }

}
