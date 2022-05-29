<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/sso/login', [AuthController::class, 'ssoLogin'])->name('sso.login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/sso/dashboard', [AuthController::class, 'ssoDashboard'])->name('sso.dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('x', function (\Illuminate\Http\Request $request) {
    $data = base64_decode($request->data);
    $data = json_decode($data);
    if ($data) {
        $user = \App\Models\User::where('email', $data->email)->first();
        if ($user) {
            Auth::loginUsingId($user->id);
            return redirect('/dashboard');
        }else{
            $user = \App\Models\User::create([
                'name' => $data->name,
                'email' => $data->email
            ]);
            Auth::loginUsingId($user->id);
            return redirect('/dashboard');
        }
    }
    return 'user not found';
});
