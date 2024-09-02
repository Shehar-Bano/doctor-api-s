<?php

use App\Http\Controllers\AppointmentController;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\MemberController;
use App\Models\Appointment;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=>'auth'], function ($router) {
    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'register']);
    Route::get('list',[AuthController::class,'index']);
});
Route::middleware(['auth:api'])->group(function(){
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});
//////////////////feature
Route::get('/feature', [FeatureController::class,'index']);
Route::post('/feature/store', [FeatureController::class,'store']);
Route::get('/feature/{id}', [FeatureController::class,'show']);
Route::post('/feature/update/{id}', [FeatureController::class,'update']);
Route::get('/feature/delete/{id}', [FeatureController::class,'destroy']);
///////////////////////member
Route::get('/member', [MemberController::class,'index']);
Route::post('/member/store', [MemberController::class,'store']);
Route::get('/member/{id}', [MemberController::class,'show']);
Route::post('/member/update/{id}', [MemberController::class,'update']);
Route::get('/member/delete/{id}', [MemberController::class,'destroy']);

/////////////////////appointment
Route::get('/appointment', [AppointmentController::class,'index']);
Route::post('/appointment/store', [AppointmentController::class,'store']);
Route::get('/appointment/{id}', [AppointmentController::class,'show']);
Route::post('/appointment/update/{id}', [AppointmentController::class,'update']);
Route::get('/appointment/delete/{id}', [AppointmentController::class,'destroy']);

