<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\BloodTypeController;
use App\Http\Controllers\API\FacilityController;
use App\Http\Controllers\API\BloodRequestController;
use App\Http\Controllers\API\OpenBloodRequestController;


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
    Route::post('forgot-password', 'forgotPassword');
    Route::get('logout', 'logout');
    Route::get('user-profile', 'profile');
    Route::get('users', 'index');   
    Route::get('user/{id}', 'show');
    Route::put('user/{id}', 'update');
    Route::put('edit-profile', 'editProfile');
    Route::put('update-password', 'updatePassword');
    Route::delete('user/{id}', 'destroy');
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
    Route::get('user-facility', 'showByLoggedUser');
    Route::post('facility', 'store');
    Route::put('facility/{name}', 'update');
    Route::delete('facility/{id}', 'destroy');
});



Route::controller(BloodRequestController::class)->group(function () {
    Route::get('blood-requests', 'index');
    Route::get('blood-request/{id}', 'show');
    Route::get('blood-requests/{facility_id}', 'showByFacility');
    Route::get('blood-requests/approved/{facility_id}', 'facilityApproved');
    Route::get('blood-requests/pending/{facility_id}', 'facilityPending');
    Route::get('user-blood-requests/{user_id}', 'userBloodRequests');
    Route::post('blood-request', 'store');
    Route::put('blood-request/{id}', 'update');
    Route::put('blood-request/approve/{id}', 'approve');
    Route::put('blood-request/disapprove/{id}', 'disapprove');
    Route::delete('blood-request/{id}', 'destroy');
});



Route::controller(OpenBloodRequestController::class)->group(function () {
    Route::get('open-blood-requests', 'index');
    Route::get('open-blood-request/{id}', 'show');
    Route::get('open-blood-requests/{user_id}', 'showByUser');
    Route::post('open-blood-request', 'store');
    Route::put('open-blood-request/{id}', 'update');
    Route::delete('open-blood-request/{id}', 'destroy');
});