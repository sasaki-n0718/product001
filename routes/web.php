<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\GroupController;

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

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

route::middleware('auth')->group(function () {
    //デフォルトで入ってるプロフページ
    route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //追記したアプリページ
    route::get('/',[ApprovalController::class,'index'])->name('index');
    route::get('/post',[ApprovalController::class,'post'])->name('post');
    route::get('/{id}',[ApprovalController::class,'index'])->whereNumber('id')->name('show');
    route::post('/post',[ApprovalController::class,'store']);
});
route::get('/group',[GroupController::class,'create'])->name('group');
route::post('/group',[GroupController::class,'store']);

require __DIR__.'/auth.php';
