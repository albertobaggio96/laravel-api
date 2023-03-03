<?php

use App\Http\Controllers\Api\ProjectController as ApiProjectController;
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

Route::get('projects/', [ApiProjectController::class, 'index'])->name('api.projects.index');
Route::get('projects/{project}', [ApiProjectController::class, 'show'])->name('api.projects.show');