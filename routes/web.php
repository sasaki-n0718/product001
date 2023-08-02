<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprovalController;


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


route::get('/',[ApprovalController::class,'home']);
route::get('/post',[ApprovalController::class,'post']);
Route::post('/post', [ApprovalController::class,'store']);
