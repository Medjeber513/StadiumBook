<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StadiumsController;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    session()->reflash();
    return match (Auth::user()->role) {
        "owner" => redirect()->route('Owner.dashboard'),
        "player" => redirect()->route('Player.dashboard'),
        default => abort(403)
    };
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('Logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Owner Routes
Route::get('Stadiums/stadiums_list', [StadiumsController::class, 'showStadiumsForPlayers'])->name('stadiumsForPlayers.list')->middleware('Player');
Route::get("Stadiums/stadium_create", [StadiumsController::class, 'create'])->middleware('Owner')->name('create_stadium');
Route::post('Stadiums/stadiums_store', [StadiumsController::class, 'store'])->middleware('Owner')->name('store_stadium');
Route::get('Stadiums/stadiums_index', [StadiumsController::class, 'index'])->middleware('Owner')->name('stadiums_index');
Route::get('Stadiums/stadium_edit/{id}', [StadiumsController::class, 'edit'])->middleware('Owner')->middleware('auth')->name('stadium_edit');
Route::post('Stadiums/stadium_update/{id}', [StadiumsController::class, 'update'])->middleware('Owner')->name('stadium_update');
Route::get('Stadiums/stadiums_delete/{id}', [StadiumsController::class, 'destroy'])->middleware('Owner')->name('delete_stadium');
Route::get('Owner/reservations_lits', [BookingController::class, 'ownerBookingsIndex'])->middleware('Owner')->name('reservation.lists.index');
Route::get('Owner/dashboard', function () {
    return view('Owner/dashboard');
})->name('Owner.dashboard')->middleware('Owner');

Route::get('Owner/reservations_lits/confirm/{id}', [BookingController::class, 'confirmBooking'])->middleware('Owner')->name('confirm.booking');
Route::get('Owner/reservations_lits/cancel/{id}', [BookingController::class, 'cancelBooking'])->middleware('Owner')->name('cancel.booking');

Route::post('Owner/reservations_lits/{id}', [BookingController::class, 'confirm'])->middleware('Owner')->name('confirm');
Route::post('Owner/reservations_lits/{id}', [BookingController::class, 'cancel'])->middleware('Owner')->name('cancel');
// Player Routes
Route::get('Stadiums/stadium_show/{id}', [StadiumsController::class, 'show'])->middleware('Player')->name('show_stadium')->middleware("Player");
Route::post('Stadiums/stadium_show/{id}', [BookingController::class, 'store'])->middleware('Player')->name('store.booking');
Route::get('Player/reservations_list', [BookingController::class, 'index'])->middleware('Player')->name('booking.index');
Route::get('Stadiums/stadiums_list', [StadiumsController::class, 'showStadiumsForPlayers'])->middleware('Player')->name('stadiumsForPlayers.list');
Route::get('Player/dashboard', function () {
    return view('Player/dashboard');
})->name('Player.dashboard')->middleware('Player');
Route::get('/stadiums/{stadium}/available-times', [BookingController::class, 'availableTimes'])
    ->name('stadium.availableTimes')->middleware('Player');
require __DIR__ . '/auth.php';
