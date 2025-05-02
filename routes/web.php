<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/listings', [ListingController::class, 'index'])->name('listings');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/newlisting', [DashboardController::class, 'newListing'])->name('newListing');
Route::get('/dashboard/editListing/{listing}', [DashboardController::class, 'editListing'])->name('editListing');
Route::post('/dashboard/newlisting/submit', [ListingController::class, 'postListing'])->name('listing.postListing');
Route::put('/dashboard/editListing/submit/{id}', [ListingController::class, 'editListing'])->name('listing.editListing');
Route::delete('/dashboard/destroyListings/{id}', [ListingController::class, 'destroyListing'])->name('listing.destroy');
Route::get('/listings/{listing}', [ListingController::class, 'itemPage'])->name('listings.item');
Route::get('/run-migrations', function () {
    \Artisan::call('migrate', ['--force' => true]);
    return 'Migrations ran!';
});