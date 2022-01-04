<?php

use App\Http\Controllers\LetterController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){
    Route::get("/", [LetterController::class, 'index'])->name("dashboard");
    Route::get("/letters", [LetterController::class, 'index'])->name("letters");
    Route::get("/letters/data", [LetterController::class, 'data'])->name("letters.data");
    Route::get("/letters/create", [LetterController::class, 'create'])->name("letters.create");
    Route::post("/letters", [LetterController::class, 'store'])->name("letters.store");
    Route::get("/letters/{letter}/download", [LetterController::class, 'download'])->name("letters.download");
    Route::get("/letters/{letter}", [LetterController::class, 'show'])->name("letters.show");

    Route::group(['middileware' => 'partner_or_admin'], function(){
        Route::get("/letters/{letter}/edit", [LetterController::class, 'edit'])->name("letters.edit");
        Route::put("/letters/{letter}", [LetterController::class, 'update'])->name("letters.update");
        Route::delete("/letters/{letter}", [LetterController::class, 'destroy'])->name("letters.destroy");

        Route::get("/users", [UserController::class, 'index'])->name("users");
        Route::get("/users/create", [UserController::class, 'create'])->name("users.create");
        Route::post("/users", [UserController::class, 'store'])->name("users.store");
        Route::put("/users/{user}", [UserController::class, 'update'])->name("users.update");
        Route::get("/users/{user}/change/activation", [UserController::class, 'change_activation'])->name("users.change_activation");
        Route::get("/users/{user}/edit", [UserController::class, 'edit'])->name("users.edit");
        Route::get("/users/{user}/change/password", [UserController::class, 'edit_password'])->name("users.edit_password");
        Route::put("/users/{user}/change/password", [UserController::class, 'update_password'])->name("users.update_password");
    });
});

/*Route::middleware(['auth:sanctum', 'verified'])->get('/letter/', function () {
    return view('welcome');
});*/

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/

/*Route::middleware(['auth:sanctum', 'verified'])->get('/letter', function () {
    return view('letter');
})->name('letter');*/
