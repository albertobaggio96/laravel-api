<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TechnologyController as AdminTechnologyController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Guest\ProjectController as GuestProjectController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('home');
});

Route::prefix("guest")->name("guest.")->group(function(){
    Route::post('/projects/search', [GuestProjectController::class, "search"])->name("search");
    Route::resource('/projects', GuestProjectController::class);
});

Route::middleware(['auth', 'verified'])->prefix("admin")->name('admin.')->group(function(){
    Route::get('/dashboard', [DashboardController::class, "index"])->name("dashboard");
    Route::post('/projects/search', [AdminProjectController::class, "search"])->name("projects.search");
    Route::get("/projects/trashed",  [AdminProjectController::class, "trashed"] )->name("projects.trashed");
    Route::get("/projects/{slug}/restore", [AdminProjectController::class, "restore"])->name("projects.restore");
    Route::delete("/projects/{slug}/force-delete", [AdminProjectController::class, "forceDelete"])->name("projects.force-delete");
    Route::delete("/projects/{project}/clear-type", [AdminProjectController::class, "clearType"])->name("projects.clear-type");
    Route::resource("/projects", AdminProjectController::class);
    Route::resource("/types", AdminTypeController::class);
    Route::resource("/technologies", AdminTechnologyController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
