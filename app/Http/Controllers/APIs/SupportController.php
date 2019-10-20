<?php

namespace App\Http\Controllers\APIs;

use App\Constants\StatusCode;
use App\Constants\UserSetting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Setting\SettingService;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $user = auth('api')->user();

        // Get dang sách order đã follow
        if (isset($user)) {
            // Danh sách id mà user đã follows
            $follows = array_column($user->getUserFollows->toArray(), 'user_id');
            $users_online = User::select('name', 'check_online', 'avatar')->where('role', '!=', UserSetting::ADMIN_ROLE)
                ->where('check_online', '!=', 'null')->whereIn('id', $follows)->get();
        } else {
            $users_online = User::select('name', 'check_online', 'avatar')->where('role', '!=', UserSetting::ADMIN_ROLE)
                ->where('check_online', '!=', 'null')->get();
        }

        return response()->json([
            'code'    => StatusCode::OK,
            'message' => __('messages.register_successful'),
            'data'    => [
                'data' => $data,
                'users_online' => $users_online
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
