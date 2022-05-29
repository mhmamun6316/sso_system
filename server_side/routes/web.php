<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

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

Route::group(['middleware'=>['guest']], function(){
    Route::get('/',[UserController::class,'loginRegister'])->name('login.register');
    Route::get('/loginfromoutside',[UserController::class,'loginfromoutside'])->name('login.from.outside');
    Route::post('/login',[UserController::class,'loginCheck'])->name('login');
    Route::post('/register',[UserController::class,'store'])->name('register');
});

Route::group(['middleware'=>['auth']], function(){
    Route::get('/dashboard',[UserController::class,'dashboard']);
    Route::get('/logout',[UserController::class,'logout'])->name('logout');
    Route::get('/all/district/{division_id}',[UserController::class,'getDistrict']);
    Route::get('/all/upazila/{district_id}',[UserController::class,'getUpazila']);
    Route::get('/all/union/{upazila_id}',[UserController::class,'getUnion']);
    Route::post('/profile/update',[UserController::class,'profileUpdate'])->name('profile.update');

    Route::post('/add/project',[ProjectController::class,'addProject'])->name('add.project');
});

// Route::get('/test',[UserController::class,'test']);
Route::get('/client/authorize',[UserController::class,'clientAuthorize'])->name('clientAuthorize');
Route::get('/sso/login',[UserController::class,'ssoLogin']);
Route::post('/sso/login',[UserController::class,'test'])->name('sso.login');

