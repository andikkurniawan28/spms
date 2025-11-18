<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComplexityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login_process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/changePassword', [AuthController::class, 'changePassword'])->name('changePassword');
Route::post('/changePassword', [AuthController::class, 'changePasswordProcess'])->name('changePasswordProcess');
Route::get('/login/captcha/refresh', function (Request $request) {
    $a = rand(1, 9);
    $b = rand(1, 9);
    $answer = $a + $b;
    session(['captcha_answer' => $answer]);
    return response()->json([
        'question' => "$a + $b = ?"
    ]);
})->name('login.captcha.refresh');
Route::get('/', function () {
    return view('welcome');
})->name('dashboard.index')->middleware(['auth']);
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(['auth']);
Route::get('/dashboard/data', [DashboardController::class, 'data'])->name('dashboard.data');
Route::resource('users', UserController::class)->middleware(['auth']);
Route::resource('clients', ClientController::class)->middleware(['auth']);
Route::resource('complexities', ComplexityController::class)->middleware(['auth']);
Route::resource('gateways', GatewayController::class)->middleware(['auth']);
Route::resource('projects', ProjectController::class)->middleware(['auth']);
