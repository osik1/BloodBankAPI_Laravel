<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\BloodTypeController;
use App\Http\Controllers\API\FacilityController;
use App\Http\Controllers\API\BloodRequestController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('logout', 'logout');
    Route::get('users', 'index');   // this is the user profile //test this later
    Route::get('user/{id}', 'user');
    Route::post('user', 'user');
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user();
 });



Route::controller(BloodTypeController::class)->group(function () {
    Route::get('blood-types', 'index');
    Route::get('blood-type/{id}', 'show');
    Route::post('blood-type', 'store');
    Route::put('blood-type/{name}', 'update');
    Route::delete('blood-type/{id}', 'destroy');
});



Route::controller(FacilityController::class)->group(function () {
    Route::get('facilities', 'index');
    Route::get('facility/{id}', 'show');
    Route::post('facility', 'store');
    Route::put('facility/{name}', 'update');
    Route::delete('facility/{id}', 'destroy');
});



Route::controller(BloodRequestController::class)->group(function () {
    Route::get('blood-requests', 'index');
    Route::get('blood-request/{id}', 'show');
    Route::get('blood-requests/{facility_id}', 'showByFacility');
    Route::get('blood-request/{ref_code}', 'show');
    Route::post('blood-request', 'store');
    Route::put('blood-request/{id}', 'update');
    Route::put('blood-request/approve/{id}', 'approve');
    Route::delete('blood-request/{id}', 'destroy');
});