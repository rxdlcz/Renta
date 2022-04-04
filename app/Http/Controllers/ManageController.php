<?php

namespace App\Http\Controllers;

use App\Models\location;
use App\Models\tenant;
use App\Models\User;
use App\Models\Unit;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManageController extends Controller
{
    //Manage Location
    public function getLocation(Request $request)
    {
        $locations = location::all();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        if ($request->ajax()) {
            //return response()->json(array('locations' => $locations));
            return response()->json([
                'locations' => $locations,
            ]);
        }
        return view('pages.manage.location', compact('data', 'locations'));
    }
    public function addLocation(Request $request)
    {

        $request->validate([
            'location' => 'required|unique:locations',
        ]);

        $location = new location();
        $location->location = $request->location;
        $res = $location->save();

        if ($res) {
            return back()->with('success', 'Successfully Added');
        } else {
            return back()->with('fail', 'Something went Wrong, Try Again');
        }
    }
    public function editLocation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required|unique:locations',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $location = location::find($id);
            $location->location = $request->location;

            $res = $location->save();
            if($res){
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            }else{
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }          
        }
    }
    public function deleteLocation(Request $request, $id)
    {

        $location = location::destroy($id);

        if ($location) {
            return back()->with('success', 'Successfully Deleted');
        } else {
            return back()->with('fail', 'Something went Wrong, Try Again');
        }
    }
    //End of Manage Location

    //Manage Users
    public function getUsers()
    {

        $users = user::all();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        return view('pages.manage.user', compact('data', 'users'));
    }

    public function getUnits()
    {

        $units = Unit::with('location')->get();
        $locations = location::with('unit')->get();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        return view('pages.manage.unit', compact('data', 'locations', 'units'));
    }

    public function getTenants()
    {

        $tenants = tenant::with('location', 'unit')->get();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        return view('pages.manage.tenant', compact('data', 'tenants'));
    }
}
