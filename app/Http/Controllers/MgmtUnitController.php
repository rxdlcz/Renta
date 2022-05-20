<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use File;
use Session;



class MgmtUnitController extends Controller
{
    //Manage Units
    public function getUnits(Request $request)
    {
        $locations = location::with('unit')->get();
        $units = unit::with('location')->get();


        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        if ($request->ajax()) {

            $units = Unit::join('locations', 'units.location_id', '=', 'locations.id')
                ->select('units.id', 'units.name', 'locations.location', 'locations.description', 'units.price', 'vacant_status')
                ->get();

            return response()->json([
                'units' => $units,
            ]);
        }
        return view('pages.manage.unit', compact('data', 'units', 'locations'));
    }
    public function addUnit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:units',
            'location_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required|max:255',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $unit = new Unit();
            $unit->name = $request->name;
            $unit->location_id = $request->location_id;
            $unit->vacant_status = 0;
            $unit->price = $request->price;
            $unit->description = $request->description;
            $unit->img = "defaultUpload.png";

            $res = $unit->save();

            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    public function editUnit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'location_id' => 'required',
            'price' => 'required|numeric',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $unit = unit::find($id);
            $unit->name = $request->name;
            $unit->location_id = $request->location_id;
            $unit->price = $request->price;

            $res = $unit->save();

            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }

    public function uploadUnit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => "required",
        ]);

        if ($request->ajax()) {
            $unit = Unit::find($id);
            $oldFile = $unit->img;

            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $fileName = time() . '.png';
            $filePath = public_path('img/unitImg/' . $fileName);

            $oldPath = 'img/unitImg/' . $oldFile;
            if (File::exists($oldPath)) {
                if ($oldPath != "defaultUpload.png") {
                    File::delete($oldPath);
                }
            }

            file_put_contents($filePath, $data);
            $unit->img = $fileName;
            $unit->save();
        }

        return response()->json(['status' => 1, 'error' => $validator->errors()->toArray(), 'debug' => $oldFile]);
    }

    public function deleteUnit(Request $request, $id)
    {
        $unit = unit::destroy($id);

        if ($unit) {
            return response()->json(['status' => 1,]);
        } else {
            return response()->json(['status' => 0,]);
        }
    }
    //End of Manage Unit 

}
