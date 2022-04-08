<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\BillController;

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

    Route::get('/', function () {
        return view('welcome');
    });

    //Route for login authentication
    Route::get('/login', [AuthController::class, 'login'])->middleware('alreadyLoggedIn');
    Route::post('login-user', [AuthController::class, 'loginUser'])->name('login-user');
    Route::get('/logout', [AuthController::class, 'logout']);

    //Route for checking Session
    Route::group(['middleware' => 'isLoggedIn'], function () {


        //Route for navigation section

        Route::get('/dashboard', [AuthController::class, 'dashboard']);

        /* All Route for Manage Nav */
        //Route for Location Nav
        Route::get('/location', [ManageController::class, 'getLocation']);
        Route::post('/addLocation', [ManageController::class, 'addLocation']);
        Route::post('/editLocation/{id}', [ManageController::class, 'editLocation']);
        Route::post('/deleteLocation/{id}', [ManageController::class, 'deleteLocation']);
        //End Route for location nav

        //Route for User Nav
        Route::get('/user', [ManageController::class, 'getUsers']);
        Route::post('/addUser', [ManageController::class, 'addUser']);
        Route::post('/editUser/{id}', [ManageController::class, 'editUser']);
        Route::post('/deleteUser/{id}', [ManageController::class, 'deleteUser']);
        //End Route for User Nav

        //Route for Unit Nav
        Route::get('/unit', [ManageController::class, 'getUnits']);
        Route::post('/addUnit', [ManageController::class, 'addUnit']);
        Route::post('/editUnit/{id}', [ManageController::class, 'editUnit']);
        Route::post('/deleteUnit/{id}', [ManageController::class, 'deleteUnit']);
        //End Route for Unit Nav

        //Route for Tenant nav
        Route::get('/tenant', [ManageController::class, 'getTenants']);
        //End Route for Tenant nav
        /* End All Route for Manage */


        //All Route for Bills
        //Route for Rent Bills nav
        Route::get('/rentbills', [BillController::class, 'getRent']);
        //End All Route for Bills
    });
});     //end of route prevent back button
