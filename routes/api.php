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

Broadcast::routes(['middleware' => ['auth:sanctum']]);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::name('frontend.')->middleware('web')->prefix('frontend')->group(function ()
{

    Route::post('login', [App\Http\Controllers\Frontend\LoginController::class, 'login'])->name('login');
    Route::post('logout', [App\Http\Controllers\Frontend\LoginController::class, 'logout'])->name('logout');
    Route::get('me', [App\Http\Controllers\Frontend\ProfileController::class, 'me'])->name('profile.show');


    Route::resource('tasks', App\Http\Controllers\Frontend\TaskController::class);


});
