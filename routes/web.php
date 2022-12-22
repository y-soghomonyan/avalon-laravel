<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/accounts', [App\Http\Controllers\AccountsController::class, 'index'])->name('accounts');

Route::post('/add_account', [App\Http\Controllers\AccountsController::class, 'add_account'])->name('add_account');

Route::post('/edit_account/{id}', [App\Http\Controllers\AccountsController::class, 'edit_account'])->name('edit_account');

Route::post('/get_parent_account_ajax', [App\Http\Controllers\AccountsController::class, 'get_parent_account_ajax'])->name('get_parent_account_ajax');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
