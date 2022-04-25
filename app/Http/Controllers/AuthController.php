<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hashids\Hashids;
use Hash;
use Session;

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
            return redirect('login');
        }
    }
}
