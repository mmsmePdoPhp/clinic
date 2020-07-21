<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
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

Route::get('/', function () {
    return ['page'=>'welcom'];
});
Route::get('redirectIfAuthenticated', function () {
    return Auth::user();
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::apiResource('post', 'PostController');

    // Route::apiResource('user', 'UserController');
});

Route::group(['middleware' => ['auth']], function () {
    Route::apiResource('users', 'UserController');
});

Route::post('login', function () {
    return ['name'=>'mohammad'];
});
