<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UniqueLinkController;
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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('signed')->group(function (){
   Route::get('/unique-link', [UniqueLinkController::class, 'index'])->name('access');

});
Route::post('/unique-link', [UniqueLinkController::class, 'store'])->name('unique-link');
Route::get('/lucky-number',[ProfileController::class,'random'])->name('lucky-number');
Route::get('/lucky-history',[ProfileController::class,'history'])->name('lucky-history');
Route::delete('/unique-link/{id}', [UniqueLinkController::class, 'destroy'])->name('unique-link-destroy');
require __DIR__.'/auth.php';
Route::get('/', function () {
    return redirect()->route('register');
});
Route::get('/admin', function () {
    return redirect()->route('login');
});
