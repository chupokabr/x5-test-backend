<?php

namespace App\Repository;


use App\Models\User;

class UserRepository
{

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public static function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
        ]);
    }

    public static function isValidToken(string $token)
    {
        return UserTokenRepository::isValidToken($token);
    }


}
