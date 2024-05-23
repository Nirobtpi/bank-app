<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[LoginController::class,'login'])->name('admin.login');

Route::prefix('admin')->group(function(){
    Route::get('/register',[LoginController::class,'register'])->name('admin.register');
    Route::post('/registation',[LoginController::class,'user_register'])->name('admin.registation');
    Route::group(['middleware'=>['admin']], function(){
        Route::get('/dashboard',[DashboardController::class,'dashboard']);
    });
});
