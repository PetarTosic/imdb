<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MoviesController::class, 'index']);
Route::get('/movies/{title}', [Moviescontroller::class, 'show']);
Route::get('/signup', [AuthController::class, 'getsignup']);
Route::get('/signin', [AuthController::class, 'getsignin']);
Route::get('/forgotpw', [AuthController::class, 'getforgotpw']);
Route::get('/signout', [AuthController::class, 'signout'])->middleware('auth');
Route::get('/changepw/{id}', [AuthController::class, 'getchangepw']);
Route::get('/settings', [AuthController::class, 'getsettings'])->middleware('auth2');
Route::get('/verify/{id}', [AuthController::class, 'verify']);
Route::get('/genres/{name}', [MoviesController::class, 'bygenre']);
Route::get('/createmovie', [MoviesController::class, 'getcreate'])->middleware('auth3');
Route::get('/creategenre', [MoviesController::class, 'getgenre'])->middleware('auth3');
Route::get('/managemovies', [MoviesController::class, 'getmanage'])->middleware('auth3');
Route::get('/updatemovie/{id}', [MoviesController::class, 'getupdate'])->middleware('auth3');

Route::post('/createmovie', [MoviesController::class, 'createmovie'])->middleware('auth3');
Route::post('/updatemovie', [MoviesController::class, 'updatemovie'])->middleware('auth3');
Route::post('/creategenre', [MoviesController::class, 'creategenre'])->middleware('auth3');
Route::get('/managemovies/{id}', [MoviesController::class, 'deletemovie'])->middleware('auth3');
Route::post('/createcomment', [MoviesController::class, 'createcomment']);
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'signin']);
Route::post('/forgotpw', [AuthController::class, 'forgotpw']);
Route::post('/changepw', [AuthController::class, 'changepw']);
Route::post('/newpw', [AuthController::class, 'newpw']);
Route::get('/{genre}', [MoviesController::class, 'index2']);