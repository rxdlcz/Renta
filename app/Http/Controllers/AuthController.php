<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    /* public function registerUser(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $res = $user->save();

        if ($res) {
            return back()->with('success', 'You have registered');
        } else {
            return back()->with('fail', 'Error');
        }
    } */
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
                //return redirect('dashboard');
                return response()->json(['status'=>true, ]);
            } else {
                return response()->json(['status'=>false, ]);
            }
        } else {
            return response()->json(['status'=>false, ]);
        }
    }
    public function dashboard()
    {
        $users = user::all();
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('pages.dashboard', compact('data'), ['users' => $users]);
    }
    public function logout(Request $request){
        if(Session::has('loginId')){
            $r = $request->session()->flush();
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
