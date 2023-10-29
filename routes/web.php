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
    Route::resource('forms', App\Http\Controllers\AdminController::class)
        ->except(['show'])
        ->names([
            'create' => 'admin.form.create',
            'store' => 'admin.store.form',
            'index' => 'admin.index',
            'edit' => 'admin.form.edit',
            'update' => 'admin.form.update',
            'destroy' => 'admin.form.destroy',
        ]);
});
Route::get('/forms', [App\Http\Controllers\PublicFormController::class, 'showForm'])->name('public.forms.index');
Route::post('/forms/{form}', [App\Http\Controllers\PublicFormController::class, 'storeResponse'])->name('public.forms.storeResponse');
Route::get('/forms/{form}', [App\Http\Controllers\PublicFormController::class, 'show'])->name('public.forms.show');
