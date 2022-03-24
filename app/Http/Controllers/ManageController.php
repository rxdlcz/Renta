<?php

namespace App\Http\Controllers;

use App\Models\location;
use App\Models\tenant;
use App\Models\User;
use App\Models\Unit;
use Session;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function getLocation(){
        
        $locations = location::all();

        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        
        return view('pages.manage.location', compact('data', 'locations'));

        
    }

    public function getUsers(){
        
        $users = user::all();

        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        
        return view('pages.manage.user', compact('data', 'users'));

    }

    public function getUnits(){

        $units = Unit::with('location')->get();
        $locations = location::with('unit')->get();

        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }

        return view('pages.manage.unit', compact('data', 'locations', 'units'));
    }

    public function getTenants(){
        
        $tenants = tenant::with('location', 'unit')->get();

        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        
        return view('pages.manage.tenant', compact('data', 'tenants'));

        
    }
}
