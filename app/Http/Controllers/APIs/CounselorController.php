<?php

namespace App\Http\Controllers\APIs;

use App\Constants\PostConstant;
use App\Constants\Setting;
use App\Constants\UserSetting;
use App\Constants\PaginateSetting;
use App\Constants\StatusCode;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CounselorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $counselors = User::select('name', 'role', 'avatar', 'career_id', 'specialized_id', 'address')
            ->whereIn('role', [UserSetting::PSYCHOLOGY_ROLE, UserSetting::JURISTIC_ROLE])->get();

        foreach ($counselors as $key => $item) {
            $item->career_name = @$item->getCareer->name;
            $item->specialized_name = @$item->getSpecialized->name;
            unset($item->getCareer, $item->getSpecialized, $item->career_id, $item->specialized_id);
        }

        return response()->json([
            'code' => StatusCode::OK,
            'message' => __('system.success'),
            'data' => [
                'counselors' => $counselors,
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $getUser = User::find($request->id);

        if (@$getUser->role == UserSetting::PSYCHOLOGY_ROLE || @$getUser->role == UserSetting::JURISTIC_ROLE) {
            $user = User::where('id', $request->id)->first();
            $user->career_name = @$user->getCareer->name;
            $user->specialized_name = @$user->getSpecialized->name;
            unset($user->getCareer, $user->getSpecialized, $user->career_id, $user->specialized_id);
        } else {
            return response()->json([
                'code' => StatusCode::OK,
                'message' => __('auth.user_not_exists'),
            ]);
        }

        if ($user) {
            return response()->json([
                'code' => StatusCode::OK,
                'message' => __('system.success'),
                'data' => [
                    'user' => $user,
                ],
            ]);
        }
    }
}
