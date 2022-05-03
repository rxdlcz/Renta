<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Mail;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username', '=', $request->username)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return response()->json(['status' => true,]);
            } else {
                return response()->json(['status' => false,]);
            }
        } else {
            return response()->json(['status' => false,]);
        }
    }

    public function logout(Request $request)
    {
        if (Session::has('loginId')) {
            $r = $request->session()->flush();
            Session::pull('loginId');
            return redirect('/');
        }
    }

    public function forgotPassword()
    {
        return view("auth.forgotPassword");
    }

    public function sendforgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $action_link = route('reset.password.form', ['token' => $token, 'email' => $request->email]);
        $body = "We have received a request to reset the password for <b>CMS RENTA</b> account associated with " . $request->email .
            ". You can reset your password by clicking the link below.";

        Mail::send(
            'auth.email-forgot',
            [
                'action_link' => $action_link,
                'body' => $body,
            ],
            function ($message) use ($request) {
                $message->from('cms.renta@gmail.com', 'RENTA CMS');
                $message->to($request->email)
                    ->subject('CMS Renta Reset Password');
            }
        );

        return back()->with('success', 'We have sent Reset password Link to your Email.');
    }

    public function resetPassword(Request $request, $token = null)
    {
        return view('auth.resetPassword')->with(['token' => $token, 'email' => $request->email]);
    }

    public function resetPass(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $check_token = \DB::table('password_resets')->where('token', $request->token)->first();

        if (!$check_token) {
            return back()->withInput()->with('fail', 'Invalid Token');
        } else {
            $user = user::whereEmail($request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            \DB::table('password_resets')->where('email', $request->email)
                ->delete();

            return redirect('/')->with('success', 'Password Successfully Reset');
        }
    }
}
