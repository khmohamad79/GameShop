<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => [
        'auth:sanctum'
    ],
], 
function () {
    Route::group([
            'prefix'    => 'user-panel',
            'name'      => 'user-panel.'
        ],
        function () {
            Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
        }
    );

    Route::post('/create-company', [AuthController::class, 'createCompany'])->name('create-company');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
