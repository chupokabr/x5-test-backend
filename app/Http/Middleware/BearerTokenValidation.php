<?php

namespace App\Http\Middleware;

use App;
use App\Contracts\UserTokenModelInterface;
use Closure;
use Illuminate\Http\Request;

class BearerTokenValidation
{
    /** @var UserTokenModelInterface */
    private $userTokenRepository;

    public function __construct(UserTokenModelInterface $userTokenRepository)
    {
        $this->userTokenRepository = $userTokenRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->bearerToken() || !$this->userTokenRepository::isValidToken($request->bearerToken())) {
            return App\Utils\ResponseUtils::errorAuthorizationResult('Доступ запрещен');
        }

        return $next($request);
    }
}
