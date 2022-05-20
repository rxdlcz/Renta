<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\location;
use App\Models\User;
use File;
use Session;



class MgmtLocationController extends Controller
{
    //Manage Location
    public function getLocation(Request $request)
    {
        $locations = location::select('id', 'location', 'description')->get();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        if ($request->ajax()) {
            return response()->json([
                'locations' => $locations,
            ]);
        }
        return view('pages.manage.location', compact('data', 'locations'));
    }
    public function addLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required|unique:locations',
            'description' => 'required|max:255',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $location = new location();
            $location->location = $request->location;
            $location->description = $request->description;
            $location->img = "defaultUpload.png";

            $res = $location->save();
            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }

    public function uploadLocation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => "required",
        ]);

        if ($request->ajax()) {
            $location = location::find($id);
            $oldFile = $location->img;

            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $fileName = time() . '.png';
            $filePath = public_path('img/locationImg/' . $fileName);

            $oldPath = 'img/locationImg/' . $oldFile;
            if (File::exists($oldPath)) {
                if ($oldPath != "defaultUpload.png") {
                    File::delete($oldPath);
                }
            }

            file_put_contents($filePath, $data);
            $location->img = $fileName;
            $location->save();
        }

        return response()->json(['status' => 1, 'error' => $validator->errors()->toArray(), 'debug' => $oldFile]);
    }

    public function editLocation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'location' => "required|unique:locations,location,$id",
            'description' => 'required|max:255',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $location = location::find($id);
            $location->location = $request->location;
            $location->description = $request->description;

            $res = $location->save();
            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    public function deleteLocation(Request $request, $id)
    {
        $location = location::find($id);
        File::delete('img/locationImg/' . $location->img);

        $location = location::destroy($id);

        if ($location) {
            return response()->json(['status' => 1,]);
        } else {
            return response()->json(['status' => 0,]);
        }
    }
    //End of Manage Location
}
