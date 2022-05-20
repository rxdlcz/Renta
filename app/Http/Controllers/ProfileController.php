<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use File;
use Hashids\Hashids;
use Session;
use Hash;

class ProfileController extends Controller
{
    //Edit Profile Function
    public function editProfile(Request $request)
    {
        $sessionUser = User::where('id', '=', Session::get('loginId'))->first();
        $id = $sessionUser['id'];

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => "required|email|unique:users,email,$id",
            'username' => "required|unique:users,username,$id",
            'profileImg' => 'image|mimes:jpeg,png,jpg',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $user = user::find($id);
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->username = $request->username;

            $res = $user->save();

            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }

    public function upload(Request $request)
    {
        $sessionUser = User::where('id', '=', Session::get('loginId'))->first();
        $id = $sessionUser['id'];
        $oldFile = $sessionUser['profImg'];

        if ($request->ajax()) {
            $user = user::find($id);

            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $fileName = time() . '.png';
            $filePath = public_path('img/adminImg/' . $fileName);

            $oldPath = 'img/adminImg/' . $oldFile;
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            file_put_contents($filePath, $data);
            $user->profImg = $fileName;
            $user->save();
        }
    }
    //End of Edit profile function

    //Change Password function
    public function updatePass(Request $request)
    {
        $sessionUser = User::where('id', '=', Session::get('loginId'))->first();
        $id = $sessionUser['id'];

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|different:old_password',
            'confirm_password' => 'required|same:new_password'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            if ($sessionUser) {
                if (Hash::check($request->old_password, $sessionUser->password)) {
                    $user = user::find($id);
                    $user->password = Hash::make($request->new_password);
                    $res = $user->save();
                    if ($res) {
                        return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
                    } else {
                        return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
                    }
                } else {
                    $invalidPass = [
                        'old_password' => ["The old password is incorrect"],
                    ];
                    return response()->json(['status' => 0, 'error' => $invalidPass]);
                }
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    //End Change password function

}
