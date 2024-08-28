<?php

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeatureController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=>'auth'], function ($router) {
    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'register']);
});
Route::middleware(['auth:api'])->group(function(){
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
    Route::get('list',[AuthController::class,'index']);
});
//////////////////feature
Route::get('/feature', [FeatureController::class,'index']);
Route::post('/feature/store', [FeatureController::class,'store']);
Route::get('/feature/{id}', [FeatureController::class,'show']);
Route::post('/feature/update/{id}', [FeatureController::class,'update']);
Route::get('/feature/delete/{id}', [FeatureController::class,'destroy']);
///////////////////////member
Route::get('/member', [FeatureController::class,'index']);
Route::post('/member/store', [FeatureController::class,'store']);
Route::get('/member/{id}', [FeatureController::class,'show']);
Route::post('/member/update/{id}', [FeatureController::class,'update']);
Route::get('/member/delete/{id}', [FeatureController::class,'destroy']);


