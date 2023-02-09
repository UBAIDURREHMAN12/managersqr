<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('get/venues', [ApiController::class, 'getVenues']);
Route::get('get/venues2', [ApiController::class, 'getVenues2']);
Route::get('get/gateways/{venue_id}', [ApiController::class, 'getGateways']);
Route::get('get/beacons/{gateway_id}', [ApiController::class, 'getbeacons']);
Route::get('get/beacon/{beacon_id}', [ApiController::class, 'getbeacon']);