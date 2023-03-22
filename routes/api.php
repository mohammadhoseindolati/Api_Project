<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/add' , [\App\Http\Controllers\InvitedUserController::class , 'store']) ;
Route::get('/list/{count}/{paginate}' , [\App\Http\Controllers\InvitedUserController::class, 'index']) ;
Route::patch('/changeStatus/{user}', [\App\Http\Controllers\InvitedUserController::class , 'update']) ;

