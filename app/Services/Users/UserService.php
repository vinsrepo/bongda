<?php

namespace App\Services\Users;

use App\Constants\AuthConstant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    /**
     * Create user
     *
     * @param request
     * @return
     */
    public function createUser($request)
    {
        $request->merge(['password' => bcrypt($request->password)]);
        User::create($request->all());
    }

    /**
     * Update user
     *
     * @param request
     * @param user_id
     * @return
     */
    public function updateUser($request, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $user->update($request->all());
    }
}
