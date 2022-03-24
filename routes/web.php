<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageController;

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
    Route::get('/registration', [AuthController::class, 'registration']);
    Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register-user');
    Route::post('login-user', [AuthController::class, 'loginUser'])->name('login-user');   
    Route::get('/logout', [AuthController::class, 'logout']);

    //Route for navigation section
    Route::group(['middleware' => 'isLoggedIn'], function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard']);
        Route::get('/location', [ManageController::class, 'getLocation']);
        Route::get('/user', [ManageController::class, 'getUsers']);
        Route::get('/unit', [ManageController::class, 'getUnits']);
        Route::get('/tenant', [ManageController::class, 'getTenants']);
    });
});     //end of route prevent back button
