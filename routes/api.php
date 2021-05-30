<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

// Get Contacts
Route::get('/getContacts', [ContactController::class, 'getContacts'])->name('getContacts');

// Get Contact detail (individual contact)
Route::get('/get_contact/{id}', [ContactController::class, 'get_contact'])->name('get_contact');

//Save Contacts
Route::post('save_contact', [ContactController::class, 'save_contact'])->name('save_contact');

//Update Contact

Route::post('update_contact/{id}', [ContactController::class, 'update_contact'])->name('update_contact');

//Delete Contact
Route::delete('deleteContact/{id}', [ContactController::class, 'deleteContact'])->name('deleteContact');