<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthenticationController;
use App\Http\Controllers\UserController;
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

Route::get('/', [CustomAuthenticationController::class, 'loginview']);

Route::get('/google/map', [CustomAuthenticationController::class, 'googleMap']);

Route::get('/register', [CustomAuthenticationController::class, 'register']);
Route::post('add/vendor', [CustomAuthenticationController::class, 'addVendor']);
Route::get('forgetpassword', [CustomAuthenticationController::class, 'forgetpassword']);
Route::post('login', [CustomAuthenticationController::class, 'authenticate']);
Route::post('send_mail', [UserController::class, 'sendMail']);
Route::get('reset/password/{email}/{id}', [UserController::class, 'resetPassword']);
Route::post('update/password', [UserController::class, 'updatePassword']);
Route::get('verify/account/{time}/{id}', [UserController::class, 'VerifyAccount']);

Route::get('/scrapping', [UserController::class, 'scrapping']);

Route::get('/test', function () {
   return view('location_base_search');
});

Route::middleware(['checkauth'])->group(function () {
    Route::get('dashboard', [CustomAuthenticationController::class, 'dashboard']);
    Route::get('instructions', [CustomAuthenticationController::class, 'instructions']);
    Route::get('admins/list', [UserController::class, 'admins']);
    Route::get('self_admins', [UserController::class, 'self_admins']);
    Route::get('moderators', [UserController::class, 'moderators']);
    Route::get('moderator/dashboard', [UserController::class, 'moderatorsDashboard']);
    Route::get('organizations', [UserController::class, 'organizations']);
    Route::get('beacons/{id}', [CustomAuthenticationController::class, 'beaconsData']);
    Route::get('venues/list', [CustomAuthenticationController::class, 'venuelist']);
    Route::get('venues/list/for/moderator', [CustomAuthenticationController::class, 'venuelistForModerator']);
    Route::get('edit/venue2/{venue_id}', [CustomAuthenticationController::class, 'EditVenue2']);
    Route::post('add/gateway', [UserController::class, 'addGateway']);
    Route::post('add/beacon', [UserController::class, 'addBeacon']);
    Route::post('add/venue', [UserController::class, 'addVenue']);
    Route::post('update/venue2', [UserController::class, 'updateVenue']);
    Route::get('edit/gateway/{gateway_id}', [UserController::class, 'editGateway']);
    Route::get('edit/beacon/{beacon_id}', [UserController::class, 'editBeacon']);
    Route::get('edit/venue/{venue_id}', [UserController::class, 'editVenue']);
    Route::post('update/gateway', [UserController::class, 'updateGateway']);
    Route::post('update/beacon', [UserController::class, 'updateBeacon']);
    Route::get('delete/gateway/{gateway_id}', [UserController::class, 'deleteGateway']);
    Route::get('delete/beacon/{beacon_id}', [UserController::class, 'deleteBeacon']);
    Route::get('delete/venue/{venueId}', [UserController::class, 'deletevenue']);
    Route::get('send/link/{id}', [UserController::class, 'sendLink']);

    Route::get('edit/organization/{id}', [UserController::class, 'editOrganization']);
    Route::get('create/org/{id?}', [UserController::class, 'LoadcreateOrgView']);
    Route::get('create/moderator/{id?}', [UserController::class, 'LoadcreateModeratorView']);
    Route::get('create/admin/{id?}', [UserController::class, 'LoadcreateAdminView']);
    Route::get('create/self/admin/{id?}', [UserController::class, 'LoadcreateSelfAdminView']);
    Route::get('edit/admin/{id}', [UserController::class, 'editAdmin']);
    Route::post('update/organization', [UserController::class, 'updateOrganization']);
    Route::post('update/admin', [UserController::class, 'updateAdmin']);
    Route::post('update/self/admin', [UserController::class, 'updateSelfAdmin']);
    Route::post('delete/organization/{id}', [UserController::class, 'deleteOrganization']);
    Route::post('delete/admin/{id}', [UserController::class, 'deleteAdmin']);
    Route::post('add/organization', [UserController::class, 'addOrganization']);
    Route::post('add/admin', [UserController::class, 'addAdmin']);
    Route::post('add/self/admin', [UserController::class, 'addSelfAdmin']);
    Route::post('add/moderator', [UserController::class, 'addModerator']);

    Route::get('venues', [UserController::class, 'getVenues']);
    Route::get('super/admin/instructions', [CustomAuthenticationController::class, 'instructions2']);
    Route::get('moderator/instructions', [CustomAuthenticationController::class, 'instructions3']);
    Route::get('beacons/show/to/moderator', [CustomAuthenticationController::class, 'beaconsDataForModerator']);
    Route::get('gateways', [UserController::class, 'getGateways']);
    Route::get('gatewaysForModerators', [UserController::class, 'getGatewaysForModerators']);

    Route::get('logout', [CustomAuthenticationController::class, 'logout']);

});

