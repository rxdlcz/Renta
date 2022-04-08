<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;
use App\Models\User;
use App\Models\tenant;
use App\Models\bill;
use Session;

class BillController extends Controller
{
    //Manage Location
    public function getRent(Request $request)
    {
        $tenants = tenant::get();
        $bills = bill::with('tenant')
            ->where('bills.bill_type', "rent")
            ->get();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        if ($request->ajax()) {

            $bills = bill::join('tenants', 'bills.tenant_id', '=', 'tenants.id')
                ->select('bills.id', 'tenants.firstname', 'bills.amount_balance', 'bills.due_date', 'bills.status')
                ->where('bills.bill_type', "rent")
                ->get();

            return response()->json([
                'bills' => $bills,
            ]);
        }
        return view('pages.bills.rentbills', compact('data', 'bills', 'tenants'));
    }
    public function addRent(Request $request)
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
    public function editRent(Request $request, $id)
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
    public function deleteRent(Request $request, $id)
    {

        $location = location::destroy($id);

        if ($location) {
            return response()->json(['status' => 1,]);
        } else {
            return response()->json(['status' => 0,]);
        }
    }
    //End of Manage Location
}
