<?php

namespace App\Services\Auth;

use App\Constants\AuthConstant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * @param $socialId
     *
     * @return object
     */
    public function checkUserBySocialId($socialId)
    {
        $user = User::where('social_id', $socialId)->first();

        return $user;
    }

    /**
     * @param $info
     *
     * @return object
     */
    public function createUser($info)
    {
        $user = User::create([
            'name' => $info->getName(),
            'email' => $info->getEmail(),
            'password' => Hash::make(Str::random(40)),
        ]);

        return $user;
    }

    /**
     * @param $socialId
     *
     * @return object
     */
    public function checkEmailExist($email)
    {
        $user = User::where('email', $email)->first();

        return $user;
    }
}
