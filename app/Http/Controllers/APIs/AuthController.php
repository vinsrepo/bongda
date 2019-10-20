<?php

namespace App\Http\Controllers\APIs;

use App\Constants\AuthConstant;
use App\Constants\Setting;
use App\Constants\StatusCode;
use App\Http\Resources\UserResource;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    /**
     * AuthController constructor.
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Basic register
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $regexName = regexName();
        $regexPass = regexPass();
        $required = [
            'name'     => ['required', $regexName, 'string', 'max:255', 'min:2'],
//            'password' => ['required', 'string', $regexPass, 'min:6'],
            'password' => ['required', 'string'],
            'email'    => ['string', 'email', 'max:255', 'unique:users'],
            'phone'    => ['unique:users', 'regex:/(0)[0-9]{9}/']
        ];
        if ($request->type == AuthConstant::TYPE_EMAIL) {
            array_push($required['email'], 'required');
        }
        if ($request->type == AuthConstant::TYPE_PHONE) {
            array_push($required['phone'], 'required');
        }
        $validator = Validator::make($request->all(), $required);
        if ($validator->fails()) {
            return response()->json([
                'code'     => StatusCode::UNPROCESSABLE_ENTITY,
                'message'  => $validator->errors()->first(),
            ]);
        }

        $user = Customer::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'phone'    => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'status' => Setting::ACTIVE,
        ]);

        if ($user) {
            $token = auth('api')->login($user);
            return response()->json([
                'code'    => StatusCode::OK,
                'message' => __('auth.register_success'),
                'data'    => [
                    'token' => $token,
                    'user'  => new UserResource($user),
                ],
            ]);
        }

        return response()->json([
            'code'    => StatusCode::NOT_FOUND,
            'message' => __('messages.register_fail'),
        ]);
    }

    /**
     * Basic Login with email
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function loginAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code'     => StatusCode::UNPROCESSABLE_ENTITY,
                'message'  => $validator->errors()->first(),
            ]);
        }
        $credentials = request(['email', 'password']);
        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json([
                    'code'    => StatusCode::NOT_FOUND,
                    'message' => __('messages.invalid_email_or_password'),
                ]);
            }
            $user = auth('api')->user();
            if ($request->header('platform')) {
                $user->platform = $request->header('platform');
            }
            if ($request->header('unique_id')) {
                $user->unique_id = $request->header('unique_id');
            }
            if ($request->header('os_version')) {
                $user->os_version = $request->header('os_version');
            }
            if ($request->header('language')) {
                $user->language = $request->header('language');
            }
            $user->update();
            return response()->json([
                'code'    => StatusCode::OK,
                'message' => __('messages.login_successful'),
                'data'    => [
                    'token' => $token,
                    'user'  => new UserResource($user),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code'    => StatusCode::INTERNAL_SERVER_ERROR,
                'message' => __('system.server_error'),
            ]);
        }
    }

    /**
     * Basic login with phone
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function loginPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'    => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code'     => StatusCode::UNPROCESSABLE_ENTITY,
                'message'  => $validator->errors()->first(),
            ]);
        }
        $credentials = request(['phone', 'password']);
        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json([
                    'code'    => StatusCode::NOT_FOUND,
                    'message' => __('auth.invalid_account'),
                ]);
            }
            $user = auth('api')->user();
            if ($request->header('platform')) {
                $user->platform = $request->header('platform');
            }
            if ($request->header('unique_id')) {
                $user->unique_id = $request->header('unique_id');
            }
            if ($request->header('os_version')) {
                $user->os_version = $request->header('os_version');
            }
            if ($request->header('language')) {
                $user->language = $request->header('language');
            }
//            $user->update();
            return response()->json([
                'code'    => StatusCode::OK,
                'message' => __('auth.login_success'),
                'data'    => [
                    'token' => $token,
                    'user'  => new CustomerResource($user),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code'    => StatusCode::INTERNAL_SERVER_ERROR,
                'message' => __('system.server_error'),
            ]);
        }
    }

    /**
     * Login Social
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function loginSocial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'social_token' => ['required'],
            'social_type'  => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code'     => StatusCode::UNPROCESSABLE_ENTITY,
                'message'  => $validator->errors()->first(),
            ]);
        }

        $info = null;
        $typeSocial = null;

        if ($request->input('social_type') == AuthConstant::TYPE_FACEBOOK) {
            try {
                $info = Socialite::driver('facebook')->userFromToken($request->input('social_token'));
            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }
        }
        if ($request->input('social_type') == AuthConstant::TYPE_GOOGLE) {
            try {
                $info = Socialite::driver('google')->userFromToken($request->input('social_token'));
            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }
        }

        if ($info) {
            $social_id = $info->getId();
            $user = $this->authService->checkUserBySocialId($social_id);

            if (!$user) {
                if ($info->getEmail()) {
                    $check_email = $this->authService->checkEmailExist($info->getEmail());
                    if ($check_email) {
                        return response()->json([
                            'code'    => StatusCode::EMAIL_EXIST,
                            'message' => __('messages.email_exist'),
                        ]);
                    }
                }
                $user = Customer::create([
                    'name'        => $info->getName(),
                    'email'       => $info->getEmail(),
                    'facebook_id'   => $info->getId(),
                    'social_type' => $request->input('social_type'),
                    'password'    => Hash::make(Str::random(40)),
                    'status' => Setting::ACTIVE,
                ]);
            }
            if ($request->header('platform')) {
                $user->platform = $request->header('platform');
            }
            if ($request->header('unique_id')) {
                $user->unique_id = $request->header('unique_id');
            }
            if ($request->header('os_version')) {
                $user->os_version = $request->header('os_version');
            }
            if ($request->header('language')) {
                $user->language = $request->header('language');
            }
            $user->update();
            $token = auth('api')->login($user);

            return response()->json([
                'code'    => StatusCode::OK,
                'message' => __('auth.register_success'),
                'data'    => [
                    'token' => $token,
                    'user'  => new UserResource($user),
                ],
            ]);
        }
        return response()->json([
            'code'    => StatusCode::NOT_FOUND,
            'message' => __('system.token_not_valid'),
        ]);
    }

    /**
     * Check phone exist
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function checkPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code'     => StatusCode::UNPROCESSABLE_ENTITY,
                'message'  => $validator->errors()->first(),
            ]);
        }

        $user = Customer::where('phone', $request->input('phone'))->first();

        if ($user) {
            return response()->json([
                'code'    => StatusCode::PHONE_EXIST,
                'message' => __('system.phone_exist'),
            ]);
        }

        return response()->json([
            'code'    => StatusCode::PHONE_NOT_EXIST,
            'message' => __('system.phone_not_exist'),
        ]);
    }

    /**
     * Forgot password
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'    => ['required'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code'     => StatusCode::UNPROCESSABLE_ENTITY,
                'message'  => $validator->errors()->first(),
            ]);
        }
        $user = Customer::where('phone', $request->input('phone'))->first();

        if (!$user) {
            return response()->json([
                'code'    => StatusCode::USER_NOT_EXIST,
                'message' => __('messages.user_not_exist'),
            ]);
        }

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json([
            'code'    => StatusCode::OK,
            'message' => __('messages.change_password_success'),
        ]);
    }

    /**
     * Change password
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->only('new_password', 'old_password'), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'    => StatusCode::UNPROCESSABLE_ENTITY,
                'message' => $validator->errors()->all(),
            ]);
        }

//        $user = $this->authService->changePassword($request);
//        $user = Customer::where('phone', $request->input('phone'))->first();
//        dd($request->all());
        $user = auth('api')->user();
        $user->update([
            'password' => Hash::make(request('new_password')),
        ]);

        try {
            if ($user) {
                return response()->json([
                    'code'    => StatusCode::OK,
                    'message' => __('auth.update_password_success'),
                ]);
            } else {
                return response()->json([
                    'code'    => StatusCode::PASSWORD_NOT_FOUND,
                    'message' => __('auth.wrong_old_password'),
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code'    => StatusCode::INTERNAL_SERVER_ERROR,
                'message' => __('messages.server_error'),
            ]);
        }
    }

    /**
     * Change Profile
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editProfile(Request $request)
    {
        $user = auth('api')->user();
        $regexName = regexName();
        $required = [
            'name'     => "required|min:2|max:255|$regexName",
            'email'    => "required|string|email|max:255|unique:users,email,$user->id",
            'phone'    => "required|unique:users,phone,$user->id|regex:/(0)[0-9]{9}/",
        ];

        $validator = Validator::make($request->all(), $required);
        if ($validator->fails()) {
            return response()->json([
                'code'     => StatusCode::UNPROCESSABLE_ENTITY,
                'message'  => $validator->errors()->first(),
            ]);
        }
        $user_check_email = Customer::where('email', $request->email)->where('id', '!=', $user->id)->first();

        if (isset($user_check_email)) {
            return response()->json([
                'code'    => StatusCode::EMAIL_EXIST,
                'message' => __('auth.email_exists'),
            ]);
        }
        $user_check_phone = Customer::where('phone', $request->phone)->where('id', '!=', $user->id)->first();

        if (isset($user_check_phone)) {
            return response()->json([
                'code'    => StatusCode::PHONE_EXIST,
                'message' => __('auth.phone_exists'),
            ]);
        }

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'address' => request('address'),
        ]);

        try {
            if ($user) {
                return response()->json([
                    'code'    => StatusCode::OK,
                    'message' => __('auth.edit_user_success'),
                ]);
            } else {
                return response()->json([
                    'code'    => StatusCode::USER_NOT_EXIST,
                    'message' => __('auth.not_edit_user_success'),
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code'    => StatusCode::INTERNAL_SERVER_ERROR,
                'message' => __('messages.server_error'),
            ]);
        }
    }
    /**
     * Change Profile
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function infoCustomer(Request $request)
    {
        $user = auth('api')->user();

        try {
            if ($user) {
                return response()->json([
                    'code'    => StatusCode::OK,
                    'message' => __('auth.user_view_success'),
                    'data'    => [
                        'customer' => $user,
                    ],
                ]);
            } else {
                return response()->json([
                    'code'    => StatusCode::USER_NOT_EXIST,
                    'message' => __('auth.not_view_user_success'),
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code'    => StatusCode::INTERNAL_SERVER_ERROR,
                'message' => __('messages.server_error'),
            ]);
        }
    }
}
