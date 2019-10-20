<?php

namespace App\Services\Posts;

use App\Constants\AuthConstant;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostService
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
