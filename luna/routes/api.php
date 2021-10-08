<?php

declare(strict_types=1);

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

$version = 'v1';
Route::group(['prefix' => $version], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('', \App\Http\Actions\Auth\Create\CreateAction::class);
        Route::delete('', \App\Http\Actions\Auth\Delete\DeleteAction::class);
    });
});
