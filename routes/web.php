<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\crudController;

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

Route::get('/crud', [crudController::class, 'getData']);
Route::post('add', [crudController::class, 'saveData']);
Route::get('/edit/{id}', [crudController::class, 'editData']);
Route::get('/delete/{id}', [crudController::class, 'delete']);
Route::post('update', [crudController::class, 'update']);
