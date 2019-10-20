<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Form User login
     * @return view
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/login');
    }
    /**
     * GET Forgot Password
     * @return view
     */
    public function getForgotPassword()
    {
        return view('auth.email');
    }

    /**
     * POST Forgot Password
     *
     * @param Illuminate\Http\Request $request
     */
    public function postForgotPassword(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user) {
            $string = strtolower(str_random(6));
            $array['body'] = date('H:i:s d-m-Y')." Xin chào: ".$user->name." Mật khẩu mới của bạn là: 
            ".$string.". Vui lòng đến trang ".url('admin/login')." để đăng nhập lại";
            $subject = "Lấy lại mật khẩu Admin";
            Mail::send('auth.passwords.email-content', $array, function ($message) use ($email, $subject) {
                $message->from(env('MAIL_USERNAME', 'admin@iadr-seaade2018.com'), 'CMS');
                $message->to($email)->subject($subject);
            });

            DB::table('users')->where('email', $email)->update(['password' => bcrypt($string)]);
            setcookie('message', 1, time() + (86400 * 30), "/");
            return redirect()->to('admin/login')->with(
                'message-success',
                'Vui lòng vào email '.$email.' của bạn để lấy mật khẩu và đăng nhập'
            );
        } else {
            return redirect('admin/forgot-password')->with('message', 'Email cần lấy lại mật khẩu không tồn tại');
        }
    }
}
