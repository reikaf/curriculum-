<?php

use App\Http\Controllers\Api\TodoController;
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

Route::get('todo', [TodoController::class, 'index'])->name('api.todo.index');
Route::post('todo/create', [TodoController::class, 'store'])->name('api.todo.create');
Route::get('todo/{todo}', [TodoController::class, 'show'])->name('api.todo.show');
Route::put('todo/{todo}/edit', [TodoController::class, 'update'])->name('api.todo.update');
Route::delete('todo/{todo}', [TodoController::class, 'destroy'])->name('api.todo.destroy');
