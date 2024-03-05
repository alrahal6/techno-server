<?php

use App\Http\Controllers\Admin_locationsController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\Day_monthsController;
use App\Http\Controllers\Load_limitsController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\Max_currentsController;
use App\Http\Controllers\Meter_locationsController;
use App\Http\Controllers\MetersController;
use App\Http\Controllers\Monthly_tariffsController;
use App\Http\Controllers\Monthly_whattsController;
use App\Http\Controllers\Overload_delay_timesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tod_onesController;
use App\Http\Controllers\Tod_twosController;
use App\Http\Controllers\Unbalance_currentsController;
use App\Http\Controllers\YearsController;
use App\Models\Admin;
use App\Models\Admin_location;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/locations', LocationsController::class); 
    Route::resource('/meters', MetersController::class); 

    Route::resource('/admins', AdminsController::class); 
    Route::resource('/adminlocation', Admin_locationsController::class); 
    Route::resource('/channels', ChannelsController::class); 
    Route::resource('/daymonth', Day_monthsController::class); 
    Route::resource('/loadlimits', Load_limitsController::class); 
    Route::resource('/maxcurrent', Max_currentsController::class); 
    Route::resource('/meterlocation', Meter_locationsController::class); 
    Route::resource('/monthlytariff', Monthly_tariffsController::class); 
    Route::resource('/monthlywhatt', Monthly_whattsController::class); 
    Route::resource('/overload', Overload_delay_timesController::class); 
    Route::resource('/todone', Tod_onesController::class); 
    Route::resource('/todtwo', Tod_twosController::class); 
    Route::resource('/unbalance', Unbalance_currentsController::class); 
    Route::resource('/years', YearsController::class);

});

require __DIR__.'/auth.php';
