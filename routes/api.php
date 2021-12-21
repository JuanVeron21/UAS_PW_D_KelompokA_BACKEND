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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register','Api\AuthController@register');
Route::post('login','Api\AuthController@login');
Route::get('email/verify/{id}', 'Api\VerificationController@verify')->name('verificationapi.verify');
Route::get('email/resend', 'Api\VerificationController@resend')->name('verificationapi.resend');

Route::group(['middleware' => 'auth:api'], function()
{
    Route::get('book','Api\BookController@index');
    Route::get('book/{id}','Api\BookController@show');
    Route::post('book','Api\BookController@store');
    Route::put('book/{id}','Api\BookController@update');
    Route::delete('book/{id}','Api\BookController@destroy');

    Route::get('user','Api\UserController@index');
    Route::get('user/{id}','Api\UserController@show');
    Route::post('user','Api\UserController@store');
    Route::put('user/{id}','Api\UserController@update');
    Route::delete('user/{id}','Api\UserController@destroy');

    Route::get('pinjam','Api\PinjamController@index');
    Route::get('pinjam/{id}','Api\PinjamController@show');
    Route::post('pinjam','Api\PinjamController@store');
    Route::put('pinjam/{id}','Api\PinjamController@update');
    Route::delete('pinjam/{id}','Api\PinjamController@destroy');

    Route::get('pekerja','Api\PekerjaController@index');
    Route::get('pekerja/{id}','Api\PekerjaController@show');
    Route::post('pekerja','Api\PekerjaController@store');
    Route::put('pekerja/{id}','Api\PekerjaController@update');
    Route::delete('pekerja/{id}','Api\PekerjaController@destroy');
});

