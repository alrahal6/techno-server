<?php

use App\Http\Controllers\Admin_locationsController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\ConnectionsController;
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

Route::group(['middleware' => ['role:super-admin|admin']], function() {

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::get('/connect', [ConnectionsController::class,'connect'])->name('connections.connect');
    Route::post('/report', [ConnectionsController::class,'report'])->name('connections.report');
    //Route::get('/report', 'ReportController@index')->name('report.index');
    //Route::post('/report', 'ReportController@show')->name('report.show');
    //Route::resource('report', App\Http\Controllers\ReportController::class);
    //Route::resource('meterservices', App\Http\Controllers\Meter_servicesController::class); 

    Route::resource('/connections', App\Http\Controllers\ConnectionsController::class);
    Route::resource('/service_statuses', App\Http\Controllers\Service_statusesController::class);
    Route::resource('/connection_statuses', App\Http\Controllers\Connection_statusesController::class);
    Route::resource('/meter_services', App\Http\Controllers\Meter_servicesController::class);


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/locations', LocationsController::class); 
    Route::resource('/meters', MetersController::class); 

    Route::resource('/admins', AdminsController::class); 
    Route::resource('/adminlocation', Admin_locationsController::class); 
    Route::resource('/channels', ChannelsController::class); 
    Route::resource('/day_months', Day_monthsController::class); 
    Route::resource('/load_limits', Load_limitsController::class); 
    Route::resource('/max_currents', Max_currentsController::class); 
    Route::resource('/meter_locations', Meter_locationsController::class); 
    Route::resource('/monthly_tariffs', Monthly_tariffsController::class); 
    Route::resource('/monthly_whatts', Monthly_whattsController::class); 
    Route::resource('/overload_delay_times', Overload_delay_timesController::class); 
    Route::resource('/tod_ones', Tod_onesController::class); 
    Route::resource('/tod_twos', Tod_twosController::class); 
    Route::resource('/unbalance_currents', Unbalance_currentsController::class); 
    Route::resource('/years', YearsController::class);

   

});

require __DIR__.'/auth.php';
