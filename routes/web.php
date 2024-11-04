<?php

use App\Http\Controllers\LeaderboardController;
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

Route::get('/', [LeaderboardController::class, 'index'])->name('leaderboard.index');


// In routes/web.php
Route::get('/recalculate-leaderboard', [LeaderboardController::class, 'recalculate'])->name('leaderboard.recalculate');
