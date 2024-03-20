<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CommentController;

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
    route::get('/',[PostController::class,'index'])->name('index');
    route::get('/post',[PostController::class,'post'])->name('post');
    route::get('/{id}',[PostController::class,'index'])->whereNumber('id')->name('show');
    route::post('/{id}/accept',[ApprovalController::class,'accept'])->whereNumber('id')->name('accept');
    route::post('/post',[PostController::class,'store']);
    route::get('/group/create',[GroupController::class,'create'])->name('group.create');
    route::post('/group/create',[GroupController::class,'store']);
    route::get('/group/edit',[GroupController::class,'edit'])->name('group.edit');
    route::post('/group/edit',[GroupController::class,'update']);
    route::post('/group/delete',[GroupController::class,'destroy'])->name('group.destroy');
    route::get('/{id}/download',[FileController::class,'download'])->whereNumber('id')->name('download');
    route::post('/comment',[CommentController::class,'store'])->name('comment');
    route::get('/{id}/edit',[PostController::class,'edit'])->whereNumber('id')->name('edit');
    route::post('/{id}/edit',[PostController::class,'update'])->whereNumber('id');
});

require __DIR__.'/auth.php';
