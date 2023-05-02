<?php

use App\Http\Controllers\ComputerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\PeripheralController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
})->name('welcome');

Route::get('/phpinfo', function() {
    return phpinfo();
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/networks/data', [NetworkController::class, 'data'])->name('networks.data');
    Route::get('/computers/data', [ComputerController::class, 'data'])->name('computers.data');
    Route::get('/peripherals/data', [PeripheralController::class, 'data'])->name('peripherals.data');
    Route::get('/products/data', [ProductController::class, 'data'])->name('products.data');

    Route::get('/users/data', [UserController::class, 'data'])->name('users.data');

    Route::resources([
        'networks' => NetworkController::class,
        'computers' => ComputerController::class,
        'peripherals' => PeripheralController::class,
        'products' => ProductController::class,
        'users' => UserController::class,
    ]);
});
