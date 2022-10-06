<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ClaimController;
use App\Http\Controllers\Api\ListsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('list', [ListsController::class, 'index'])->name('api.list.index');

Route::post('about/create', [AboutController::class, 'store'])->name('api.about.create');
Route::get('about/{id}', [AboutController::class, 'show'])->name('api.about.show');
Route::put('about/{id}/edit', [AboutController::class, 'update'])->name('api.about.update');
Route::delete('about/{id}', [AboutController::class, 'destroy'])->name('api.about.destroy');

Route::post('claim/{about}/create', [ClaimController::class, 'store'])->name('api.claim.create');
Route::get('claim/{id}', [ClaimController::class, 'show'])->name('api.claim.show');
Route::put('claim/{id}/edit', [ClaimController::class, 'update'])->name('api.claim.update');
Route::delete('claim/{id}', [ClaimController::class, 'destroy'])->name('api.claim.destroy');
