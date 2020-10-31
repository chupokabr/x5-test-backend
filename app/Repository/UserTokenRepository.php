<?php

namespace App\Repository;

use App\Contracts\UserTokenModelInterface;
use App\Models\User;
use App\Models\UserToken;
use Carbon\Carbon;
use Str;
use Hash;
use DateInterval;
use DateTime;

class UserTokenRepository implements UserTokenModelInterface
{
    public static function find(string $token)
    {
        return UserToken::find($token);
    }

    /**
     * @param string   $token
     *
     * @return bool
     */
    public static function isValidToken(string $token): bool
    {
        return UserToken::where('token', $token)->count() > 0;
    }

    public static function generateUserToken(int $userId, bool $remember = false): ?UserToken
    {

        if (!$userId) {
            return null;
        }

        $token = new UserToken();
        $token->token = Str::random(config('app.token_size'));
        $token->user_id = $userId;
        $token->remember = $remember;
        $token->exp_date = (new DateTime())->add(new DateInterval(config('app.token_lifetime')));
        $token->save();

        return $token;
    }

    public static function getUserInfoByToken(string $token) : ?User
    {
        return self::find($token)->user;
    }
}
