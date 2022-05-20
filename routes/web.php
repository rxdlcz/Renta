<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\MgmtLocationController;
use App\Http\Controllers\MgmtUnitController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route to prevent back button



Route::group(['middleware' => 'prevent-back-history'], function () {

    //Route for login authentication

    Route::get('/', [AuthController::class, 'login'])->middleware('alreadyLoggedIn');
    Route::post('login-user', [AuthController::class, 'loginUser'])->name('login-user');
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/forgotPassword', [AuthController::class, 'forgotPassword']);
    Route::post('/sendforgotPassword', [AuthController::class, 'sendforgotPassword']);

    Route::get('/resetPassword/{token}', [AuthController::class, 'resetPassword'])->name('reset.password.form');
    Route::post('/resetPass', [AuthController::class, 'resetPass']);

    //Route for checking Session
    Route::group(['middleware' => 'isLoggedIn'], function () {


        //Route for navigation section

        Route::get('/dashboard', [ManageController::class, 'dashboard']);
        Route::get('/getBillDetails/{id}', [ManageController::class, 'getBillDetails']);
        Route::post('/addPayment', [ManageController::class, 'addPayment']);
        Route::post('/deletePayment/{id}', [BillController::class, 'deletePayment']);

        /* All Route for Manage Nav */
        //Route for Location Nav
        Route::get('/location', [MgmtLocationController::class, 'getLocation']);
        Route::post('/addLocation', [MgmtLocationController::class, 'addLocation']);
        Route::post('/uploadLocation/{id}', [MgmtLocationController::class, 'uploadLocation']);
        Route::post('/editLocation/{id}', [MgmtLocationController::class, 'editLocation']);
        Route::post('/deleteLocation/{id}', [MgmtLocationController::class, 'deleteLocation']);
        //End Route for location nav

        //Route for User Nav
        Route::get('/user', [ManageController::class, 'getUsers']);
        Route::post('/addUser', [ManageController::class, 'addUser']);
        Route::post('/editUser/{id}', [ManageController::class, 'editUser']);
        Route::post('/deleteUser/{id}', [ManageController::class, 'deleteUser']);
        //End Route for User Nav

        //Route for Unit Nav
        Route::get('/unit', [MgmtUnitController::class, 'getUnits']);
        Route::post('/addUnit', [MgmtUnitController::class, 'addUnit']);
        Route::post('/uploadUnit/{id}', [MgmtUnitController::class, 'uploadUnit']);
        Route::post('/editUnit/{id}', [MgmtUnitController::class, 'editUnit']);
        Route::post('/deleteUnit/{id}', [MgmtUnitController::class, 'deleteUnit']);
        //End Route for Unit Nav

        //Route for Tenant nav
        Route::get('/tenant', [ManageController::class, 'getTenants']);
        Route::post('/addTenant', [ManageController::class, 'addTenant']);
        Route::get('/getTenantDetails/{id}', [ManageController::class, 'getTenantDetails']);
        Route::post('/editTenant/{id}', [ManageController::class, 'editTenant']);
        Route::post('/deleteTenant/{id}', [ManageController::class, 'deleteTenant']);
        //End Route for Tenant nav
        /* End All Route for Manage */


        //All Route for Bills
        //Route for Payment
        Route::get('/payment', [BillController::class, 'getPayment']);

        //Route for deleting bills
        Route::post('/deleteBills/{id}', [BillController::class, 'deleteBills']);

        //Route for Rent Bills nav
        Route::get('/rentbills', [BillController::class, 'getRent']);
        Route::post('/addRent', [BillController::class, 'addRent']);
        Route::post('/editRent/{id}', [BillController::class, 'editRent']);
        //End of Rent Bills nav

        //Route for Electric Bills
        Route::get('/electricbills', [BillController::class, 'getElectric']);
        Route::post('/addElectric', [BillController::class, 'addElectric']);
        Route::post('/editElectric/{id}', [BillController::class, 'editElectric']);
        //End of Route for Electric bills

        //Route for Water Bills
        Route::get('/waterbills', [BillController::class, 'getWater']);
        Route::post('/addWater', [BillController::class, 'addWater']);
        Route::post('/editWater/{id}', [BillController::class, 'editWater']);
        //End of Route for Water bills
        //End All Route for Bills

        //Route for Profile
        Route::post('/editProfile', [ProfileController::class, 'editProfile']);
        Route::post('/updatePass', [ProfileController::class, 'updatePass']);
        Route::post('/upload', [ProfileController::class, 'upload']);
        //End of Profile Route
    });
});     //end of route prevent back button
