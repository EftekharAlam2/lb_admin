<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\AccountsController;
use App\Http\Controllers\frontend\AddProductController;
use App\Http\Controllers\frontend\EditProductController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\ProductsController;
use App\Http\Controllers\UpdateInfoController;
use App\Http\Controllers\AdditionalInfoController;

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
Route::get('/',[IndexController::class, 'index']);
Route::get('/accounts',[AccountsController::class, 'index']);
Route::get('/add-product',[AddProductController::class, 'index']);
Route::get('/edit-product',[EditProductController::class, 'index']);
Route::get('/login',[LoginController::class, 'index']);
Route::get('/products',[ProductsController::class, 'index']);
Route::get('/get-update-info', [UpdateInfoController::class, 'getUpdateInfo']);
Route::post('/update-info', [UpdateInfoController::class, 'update']);
Route::get('/get-additional-info', [AdditionalInfoController::class, 'getAdditionalInfo']);
Route::post('/additional-information', [AdditionalInfoController::class, 'update']);
