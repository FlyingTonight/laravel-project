<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
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

Route::get('/', [PageController::class, 'main'])->name('main');
Route::get('/about', [PageController::class, 'about']);
Route::get('/service', [PageController::class, 'service']);
Route::get('/projects', [PageController::class, 'projects']);
Route::get('/contact', [PageController::class, 'contact']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('authenticate',[Authcontroller::class, 'authenticate'])->name('authenticate');
Route::post('logout',[Authcontroller::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_store'])->name('register.store');

Route::resources([
    'posts' => PostController::class,
    'comments' =>CommentController::class,
    'users' => UserController::class,
]);



// Route::resource('posts', PostController::class);



