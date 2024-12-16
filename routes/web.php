<?php

use App\Http\Controllers\FighterController;
use App\Http\Controllers\FinalScoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoundScoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/rooms/{room_id}/calculate-scores', [RoundScoreController::class, 'showRoundScores'])
    ->name('round-scores.calculate');
Route::get('/rooms/{room_id}/calculate-scores', [RoundScoreController::class, 'calculateAverage'])->name('round-scores.calculate');

Route::post('/round-scores/store', [RoundScoreController::class, 'store'])->name('round-scores.store');

Route::get('/finalscore/{room_id}', [FinalScoreController::class, 'show'])->name('finalscore.show');
Route::post('/finalscore/store', [FinalScoreController::class, 'store'])->name('finalscore.store');

// Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');

Route::get('/fighter.index', [FighterController::class, 'index'])->name('fighter.index');

Route::get('/history.index', [FinalScoreController::class, 'index'])->name('history.index');
Route::get('/finalscore/{id}/edit', [FinalScoreController::class, 'edit'])->name('finalscore.edit');
Route::put('/finalscore/{id}', [FinalScoreController::class, 'update'])->name('finalscore.update');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';
