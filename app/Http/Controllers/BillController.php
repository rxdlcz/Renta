<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\tenant;
use App\Models\payment;
use App\Models\Unit;
use App\Models\bill;
use Hashids\Hashids;
use Session;
use DB;

class BillController extends Controller
{
    //Bills functionality
    //Delete bills Function
    public function deleteBills(Request $request, $id)
    {
        $bills = bill::destroy($id);

        if ($bills) {
            return response()->json(['status' => 1,]);
        } else {
            return response()->json(['status' => 0,]);
        }
    }
    //End bills funtion

    //Rent bill nav
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
                ->select('bills.id', DB::raw("CONCAT(tenants.firstname,' ', tenants.lastname) AS fullname"), 'bills.amount_balance', 'bills.due_date', 'bills.status')
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
            'tenant_id' => 'required',
            'amount_balance' => 'required|numeric',
            'due_date' => 'required|date_format:Y-m-d',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $bills = new bill();
            $bills->tenant_id = $request->tenant_id;
            $bills->bill_type = "rent";
            $bills->amount_balance = $request->amount_balance;
            $bills->due_date = $request->due_date;
            $bills->status = "2";

            $res = $bills->save();
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
            'tenant_id' => 'required',
            'amount_balance' => 'required|numeric',
            'due_date' => 'required|date_format:Y-m-d',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $bills = bill::find($id);
            $bills->tenant_id = $request->tenant_id;
            $bills->bill_type = "rent";
            $bills->amount_balance = $request->amount_balance;
            $bills->due_date = $request->due_date;
            $bills->status = "2";

            $res = $bills->save();
            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    //End of Rent bill nav

    //Electric bill nav
    public function getElectric(Request $request)
    {
        $tenants = tenant::get();
        $bills = bill::with('tenant')
            ->where('bills.bill_type', "electric")
            ->get();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        if ($request->ajax()) {
            $bills = bill::join('tenants', 'bills.tenant_id', '=', 'tenants.id')
                ->select('bills.id', DB::raw("CONCAT(tenants.firstname,' ', tenants.lastname) AS fullname"), 'bills.amount_balance', 'bills.due_date', 'bills.status')
                ->where('bills.bill_type', "electric")
                ->get();

            return response()->json([
                'bills' => $bills,
            ]);
        }
        return view('pages.bills.electricbills', compact('data', 'bills', 'tenants'));
    }
    public function addElectric(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required',
            'amount_balance' => 'required|numeric',
            'due_date' => 'required|date_format:Y-m-d',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $bills = new bill();
            $bills->tenant_id = $request->tenant_id;
            $bills->bill_type = "electric";
            $bills->amount_balance = $request->amount_balance;
            $bills->due_date = $request->due_date;
            $bills->status = "2";

            $res = $bills->save();
            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    public function editElectric(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required',
            'amount_balance' => 'required|numeric',
            'due_date' => 'required|date_format:Y-m-d',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $bills = bill::find($id);
            $bills->tenant_id = $request->tenant_id;
            $bills->bill_type = "electric";
            $bills->amount_balance = $request->amount_balance;
            $bills->due_date = $request->due_date;
            $bills->status = "2";

            $res = $bills->save();
            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    //End of electric bill nav

    //Electric bill nav
    public function getWater(Request $request)
    {
        $tenants = tenant::get();
        $bills = bill::with('tenant')
            ->where('bills.bill_type', "water")
            ->get();

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        if ($request->ajax()) {
            $bills = bill::join('tenants', 'bills.tenant_id', '=', 'tenants.id')
                ->select('bills.id', DB::raw("CONCAT(tenants.firstname,' ', tenants.lastname) AS fullname"), 'bills.amount_balance', 'bills.due_date', 'bills.status')
                ->where('bills.bill_type', "water")
                ->get();

            return response()->json([
                'bills' => $bills,
            ]);
        }
        return view('pages.bills.waterbills', compact('data', 'bills', 'tenants'));
    }
    public function addWater(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required',
            'amount_balance' => 'required|numeric',
            'due_date' => 'required|date_format:Y-m-d',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $bills = new bill();
            $bills->tenant_id = $request->tenant_id;
            $bills->bill_type = "water";
            $bills->amount_balance = $request->amount_balance;
            $bills->due_date = $request->due_date;
            $bills->status = "2";

            $res = $bills->save();
            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    public function editWater(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required',
            'amount_balance' => 'required|numeric',
            'due_date' => 'required|date_format:Y-m-d',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $bills = bill::find($id);
            $bills->tenant_id = $request->tenant_id;
            $bills->bill_type = "water";
            $bills->amount_balance = $request->amount_balance;
            $bills->due_date = $request->due_date;
            $bills->status = "2";

            $res = $bills->save();
            if ($res) {
                return response()->json(['status' => 1, 'error' => $validator->errors()->toArray()]);
            } else {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
        }
    }
    //End of electric bill nav

    //Payment nav
    public function getPayment(Request $request)
    {
        $tenants = tenant::get();
        $units = unit::get();
        $bills = bill::where('status', '!=', '3')->count();
        $payments = payment::with('tenant', 'bill')->get();

        $data = array();    
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
            $users = User::all()->except(Session::get('loginId'));
        }

        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        if ($request->ajax()) {
            $payments = payment::join('tenants', 'payments.tenant_id', '=', 'tenants.id')
                ->join('bills', 'payments.bill_id', '=', 'bills.id')
                ->select('payments.id', DB::raw("CONCAT(tenants.firstname,' ', tenants.lastname) AS fullname"),'bills.bill_type', 'payments.amount', 'payments.created_at')
                ->get();

            return response()->json([
                'payments' => $payments,
            ]);
        }

        return view('pages.bills.payment', compact('data', 'units', 'tenants', 'bills', 'users'));
    }
    public function deletePayment(Request $request, $id)
    {
        $bill_id = payment::select('bill_id')
            ->where('id', $id)
            ->get();

        $bill = bill::find($bill_id)->first();
        $bill->status = '2';
        $bill->save();

        $payments = payment::destroy($id);

        if ($payments) {
            return response()->json(['status' => 1,]);
        } else {
            return response()->json(['status' => 0,]);
        }
    }
    //End bills funtion
}
