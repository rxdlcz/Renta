<?php

namespace App\Http\Controllers;

use App\Models\location;
use App\Models\tenant;
use App\Models\User;
use App\Models\Unit;
use App\Models\bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hashids\Hashids;
use Hash;
use Session;
use DB;

class ManageController extends Controller
{
    //Manage Location
    public function getLocation(Request $request)
    {
        $locations = location::select('id', 'location')->get();

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
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $location = new location();
            $location->location = $request->location;

            $res = $location->save();
            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    public function editLocation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'location' => "required|unique:locations,location,$id",
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $location = location::find($id);
            $location->location = $request->location;

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

        $location = location::destroy($id);

        if ($location) {
            return response()->json(['status' => 1,]);
        } else {
            return response()->json(['status' => 0,]);
        }
    }
    //End of Manage Location

    //Manage Users
    public function getUsers(Request $request)
    {

        $users = user::select('id', 'firstname', 'lastname', 'email', 'username')->get();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        if ($request->ajax()) {
            return response()->json([
                'users' => $users,
            ]);
        }
        return view('pages.manage.user', compact('data', 'users'));
    }
    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->profImg = 'defaultimage.png';
            $res = $user->save();

            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    public function editUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => "required|email|unique:users,email,$id",
            'username' => "required|unique:users,username,$id",
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
    public function deleteUser(Request $request, $id)
    {
        $users = user::destroy($id);

        if ($users) {
            return response()->json(['status' => 1,]);
        } else {
            return response()->json(['status' => 0,]);
        }
    }
    //End Of Manage User

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
                ->select('units.id', 'units.name', 'locations.location', 'units.price', 'vacant_status')
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
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $unit = new Unit();
            $unit->name = $request->name;
            $unit->location_id = $request->location_id;
            $unit->vacant_status = 0;
            $unit->price = $request->price;

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

    //Manage tenants
    public function getTenants(Request $request)
    {

        $tenants = tenant::with('unit')->get();
        $units = unit::where('vacant_status', 0)
            ->get();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        if ($request->ajax()) {

            $tenants = tenant::join('units', 'tenants.unit_id', '=', 'units.id')
                ->select('tenants.id', DB::raw("CONCAT(tenants.firstname,' ', tenants.lastname) AS fullname"), 'units.name', 'tenants.contact_number', 'tenants.status')
                ->get();

            return response()->json([
                'tenants' => $tenants,
            ]);
        }

        return view('pages.manage.tenant', compact('data', 'tenants', 'units'));
    }

    public function getTenantDetails($id)
    {
        $tenants = tenant::find($id);
        $bills = bill::where('tenant_id', $id)
            ->get();

        return response()->json([
            'tenants' => $tenants,
            'bills' => $bills,
        ]);
    }

    public function addTenant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:tenants',
            'contact_number' => 'required',
            'occupation_status' => 'required',
            'unit_id' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'status' => 'required|numeric',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $tenant = new tenant();
            $tenant->firstname = $request->firstname;
            $tenant->lastname = $request->lastname;
            $tenant->email = $request->email;
            $tenant->contact_number = $request->contact_number;
            $tenant->occupation_status = $request->occupation_status;
            $tenant->unit_id = $request->unit_id;
            $tenant->start_date = $request->start_date;
            $tenant->end_date = $request->end_date;
            $tenant->status = $request->status;
            $tenant->identity_id = 1;

            $unit = Unit::find($request->unit_id);
            $unit->vacant_status = '1';
            $unit->save();

            $res = $tenant->save();

            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    public function editTenant(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => "required|email|unique:tenants,email, $id",
            'contact_number' => 'required',
            'occupation_status' => 'required',
            'unit_id' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'status' => 'required|numeric',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $tenant = tenant::find($id);
            $tenant->firstname = $request->firstname;
            $tenant->lastname = $request->lastname;
            $tenant->email = $request->email;
            $tenant->contact_number = $request->contact_number;
            $tenant->occupation_status = $request->occupation_status;
            $tenant->unit_id = $request->unit_id;
            $tenant->start_date = $request->start_date;
            $tenant->end_date = $request->end_date;
            $tenant->status = $request->status;

            $res = $tenant->save();

            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    public function deleteTenant(Request $request, $id)
    {
        $tenant = tenant::destroy($id);

        if ($tenant) {
            return response()->json(['status' => 1,]);
        } else {
            return response()->json(['status' => 0,]);
        }
    }
}



////////// Debug Code

        /* $units = DB::table('units')
                    ->join('locations','locations.location', '=', 'units.location_id')
                    ->select('units.id', 'units.name', 'locations.location', 'units.price')
                    ->get();

         */

        /* $units = Unit::select('units.id', 'units.name', 'units.location_id', 'units.price')
                    ->join('units','locations.location', '=', 'units.location_id')
                    ->get();
        */
        /* $units = DB::table('locations')
                    ->join('units','locations.id', '=', 'units.location_id')
                    ->select('units.id', 'units.name', 'locations.location', 'units.price')             //fix
                    ->get(); */


        /* $units = location::join('units','locations.id', '=', 'units.location_id')
                    ->select('units.id', 'units.name', 'locations.location', 'units.price')
                    ->get(); */


        //// get tenants has many
        /*   $units = Unit::with('location')->get();
        $locations = location::with('unit')->get();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        return view('pages.manage.unit', compact('data', 'locations', 'units'));
        */

        //join parameters join('db where to get', 'currentTable.column to be join', '=', 'db where to get.what column will be get')
        /* $units = Unit::join('locations', 'units.location_id', '=', 'locations.id')
                    ->select('units.id', 'units.name', 'locations.location', 'units.price')
                    ->get(); */