<?php

namespace App\Http\Controllers\APIs;

use App\Constants\PostConstant;
use App\Constants\Setting;
use App\Constants\UserSetting;
use App\Constants\PaginateSetting;
use App\Constants\StatusCode;
use App\Models\User;
use App\Models\UserFollows;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * list Post Favorite
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function actionUserFollows(Request $request)
    {
        $user = auth('api')->user();
        $userFollow = User::find($request->id);
        if (!$userFollow) {
            return response()->json([
                'code'    => StatusCode::NOT_FOUND,
                'message' => __('post.post_not_exists'),
            ]);
        }
        $user_follow = UserFollows::where('user_id', $request->id)->where('customer_id', $user->id)->first();
        if (!$user_follow) {
            UserFollows::create([
                'user_id' => $request->id,
                'customer_id' => $user->id,
            ]);
        } else {
            $user_follow->delete();
        }

        return response()->json([
            'code' => StatusCode::OK,
            'message' => __('system.success'),
        ]);
    }

    /**
     * list Post Favorite
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function listUserFollows()
    {
        $user = auth('api')->user();
        $user_follows = User::select('id', 'name', 'avatar', 'introduce', 'created_at', 'updated_at')
            ->orderBy('created_at', 'desc')
            ->whereIn('role', [UserSetting::PSYCHOLOGY_ROLE, UserSetting::JURISTIC_ROLE])
            ->whereHas('getUserFollow', function ($query) use ($user) {
                $query->where('customer_id', $user->id);
            })->get();

        return response()->json([
            'code' => StatusCode::OK,
            'message' => __('system.list_data'),
            'data' => $user_follows
        ]);
    }
}
