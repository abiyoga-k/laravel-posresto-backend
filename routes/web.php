<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/login', function () {
//     return view('dashboard.pages.auth.login');
// });
// Route::get('/register', function () {
//     return view('dashboard.pages.auth.register');
// });


// Route::resource('products', ProductController::class);

Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return 'HELLO';
            }
        }
    });
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
    Route::resource('dashboard/categories', CategoryController::class);
    Route::resource('dashboard/products', ProductController::class);
    Route::resource('dashboard/users', UserController::class);
});
