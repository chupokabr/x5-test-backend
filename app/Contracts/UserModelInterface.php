<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface UserModelInterface
{
    /**
     * @param int   $userId
     * @param array $select
     *
     * @return Collection
     */
    public static function find(int $userId, array $select);

}
