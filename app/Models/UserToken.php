<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    /** @var bool  */
    public $timestamps = false;

    /** @var string  */
    protected $table = 'user_token';

    /** @var string  */
    protected $primaryKey = 'token';

    /** @var string  */
    protected $keyType = 'string';

    public $incrementing = false;

    protected $casts = [
        'token' => 'string',
    ];
    /** @var array  */
    protected $fillable = [
        'token', 'user_id', 'remember', 'exp_date',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
