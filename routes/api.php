<?php

use App\Http\Controllers\API\CommandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/user.php', [CommandController::class, 'index'])->name('command');
Route::post('/login.php', [CommandController::class, 'login'])->name('command');
Route::post('/commands.php', [CommandController::class, 'store'])->name('store');
Route::post('/fetch.php', [CommandController::class, 'metercmd'])->name('metercmd');
Route::post('/update.php',[CommandController::class, 'meterupdcmd'])->name('meterupdcmd');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
