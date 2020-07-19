<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('user', 'UserController');

Route::apiResource('post', 'PostController');

Route::post('login', function (Request $request) {
    return [
        'name' => 'mohammad',
        'data' =>
            [
                'email' => $request['email'],
                'password' => $request['password']
            ]
    ];
});


