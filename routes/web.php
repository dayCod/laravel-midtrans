<?php

use App\Http\Controllers\MidtransController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MidtransController::class, 'checkout_form']);
Route::get('/checkout', [MidtransController::class, 'index']);
Route::post('/checkout', [MidtransController::class, 'checkout_post']);
