<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\RegisterController;
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
});

Route::get(
    '/business/show-all',
    [BusinessController::class, 'showAll']
);

Route::get(
    '/business/show/{id}',
    [BusinessController::class, 'show']
);

Route::get(
    '/dispatch/',
    [RegisterController::class, 'index']
);

Route::get(
    '/valid/{string}',
    [BusinessController::class, 'valid']
);

