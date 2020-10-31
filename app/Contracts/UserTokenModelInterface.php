<?php

namespace App\Contracts;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Database\Eloquent\Collection;

interface UserTokenModelInterface
{
    /**
     * @param string $token
     *
     * @return Collection
     */
    public static function find(string $token);



    /**
     * @param string $token
     * @return bool
     */
    public static function isValidToken(string $token): bool;

    /**
     * @param int $userId
     * @param bool $remember
     * @return UserToken|null
     */
    public static function generateUserToken(int $userId, bool $remember = false): ?UserToken;

    /**
     * @param string $token
     * @return User|null
     */
    public static function getUserInfoByToken(string $token) : ?User;
}
