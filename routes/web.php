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
    Route::post('/login',[LoginController::class,'user_login'])->name('user.login');
    // Route::get('/me/{i}',[DashboardController::class,'calculateWithdrawFee']);
    


    Route::group(['middleware'=>['admin']], function(){
        Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
        Route::get('/deposit',[DashboardController::class,'deposit'])->name('deposit');
        Route::get('/add-deposit',[DashboardController::class,'depositUrl'])->name('admin.deposit');
        Route::Post('/add-deposit/{id}',[DashboardController::class,'addDeposit'])->name('add.deposit');
        Route::get('/withdrawal-list',[DashboardController::class,'getWithdraw'])->name('admin.withdraw');
        Route::get('/withdraw',[DashboardController::class,'withdrawUrl'])->name('add.withdrawPage');
        Route::post('/add-withdraw/{id}',[DashboardController::class,'addWithdraw'])->name('add.withdraw');
        Route::get('/logout',[LoginController::class,'logout'])->name('user.logout');
    });


});
