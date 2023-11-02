<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/forms', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.form.create');
    Route::post('/store-form', [App\Http\Controllers\AdminController::class, 'storeForm'])->name('admin.store.form');
    Route::get('/index', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/forms/{form}/edit', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.form.edit');
    Route::delete('/forms/{form}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.form.destroy');
    Route::put('/forms/{form}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.form.update');
});
Route::get('/forms', [App\Http\Controllers\PublicFormController::class, 'showForm'])->name('public.forms.index');
Route::post('/forms/{form}', [App\Http\Controllers\PublicFormController::class, 'storeResponse'])->name('public.forms.storeResponse');
Route::get('/forms/{form}', [App\Http\Controllers\PublicFormController::class, 'show'])->name('public.forms.show');
