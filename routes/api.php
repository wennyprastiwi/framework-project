<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\KPController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'kp'], function() {
    Route::get('', [KPController::class, 'index']);
    Route::post('create', [KPController::class, 'create']);
    Route::get('show/{id}', [KPController::class, 'show']);
    Route::post('edit',[KPController::class, 'edit']);
    Route::delete('{id}', [KPController::class, 'destroy']);
});
