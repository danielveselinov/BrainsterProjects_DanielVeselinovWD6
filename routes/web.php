<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
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

Route::get('/', function () { return to_route('login'); });
Route::middleware(['auth'])->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('filter', [DashboardController::class, 'filter'])->name('dashboard.filter');
    Route::resource('profile', ProfileController::class)->except(['create', 'store', 'edit', 'destroy']);
    Route::resource('projects', ProjectController::class)->except(['show'])->middleware(['completed']); 
    Route::resource('applications', ApplicationController::class)->except(['create', 'update', 'edit'])->middleware(['completed']); 
});

require __DIR__.'/auth.php';
