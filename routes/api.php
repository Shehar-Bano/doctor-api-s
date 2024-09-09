<?php

use App\Http\Controllers\AdviceController;
use App\Http\Controllers\AppointmentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReviewController;

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

////////////////////////////advice
Route::get('/advice', [AdviceController::class,'index']);
Route::post('/advice/store', [AdviceController::class,'store']);
Route::get('/advice/{id}', [AdviceController::class,'show']);
Route::post('/advice/update/{id}', [AdviceController::class,'update']);
Route::get('/advice/delete/{id}', [AdviceController::class,'destroy']);
Route::get('/option', [AdviceController::class,'selectoption']);

///////////////////////////category
Route::get('/category', [CategoryController::class,'index']);
Route::post('/category/store', [CategoryController::class,'store']);
Route::get('/category/{id}', [CategoryController::class,'show']);
Route::post('/category/update/{id}', [CategoryController::class,'update']);
Route::get('/category/delete/{id}', [CategoryController::class,'destroy']);

////////////////////////////////blog
Route::get('/blog', [BlogController::class,'index']);
Route::post('/blog/store', [BlogController::class,'store']);
Route::get('/blog/{id}', [BlogController::class,'show']);
Route::post('/blog/update/{id}', [BlogController::class,'update']);
Route::get('/blog/delete/{id}', [BlogController::class,'destroy']);
Route::get('/blog/comment/{id}', [BlogController::class,'comment']);

////////////////////////comment
Route::get('/comment', [CommentController::class,'index']);
Route::post('/comment/store', [CommentController::class,'store']);
Route::get('/comment/show/{id}', [CommentController::class,'show']);
Route::post('/comment/update/{id}', [CommentController::class,'update']);
Route::get('/comment/delete/{id}', [CommentController::class,'destroy']);

//////////////////////////reviews
Route::get('/review', [ReviewController::class,'index']);
Route::post('/review/store', [ReviewController::class,'store']);
Route::get('/review/{id}', [ReviewController::class,'show']);
Route::post('/review/update/{id}', [ReviewController::class,'update']);
Route::get('/review/delete/{id}', [ReviewController::class,'destroy']);

////////////////////////contact

Route::get('/contact', [ContactController::class,'index']);
Route::post('/contact/store', [ContactController::class,'store']);
Route::get('/contact/{id}', [ContactController::class,'show']);
Route::post('/contact/update/{id}', [ContactController::class,'update']);
Route::get('/contact/delete/{id}', [ContactController::class,'destroy']);
