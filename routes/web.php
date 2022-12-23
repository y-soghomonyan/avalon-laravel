<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/companies', [App\Http\Controllers\AccountsController::class, 'index'])->name('companies');
Route::post('/add_account', [App\Http\Controllers\AccountsController::class, 'add_account'])->name('add_account');
Route::match(['post', 'get'],'/edit_company/{id}', [App\Http\Controllers\AccountsController::class, 'edit_company'])->name('edit_company');
Route::get('/delete_company/{id}', [App\Http\Controllers\AccountsController::class, 'delete_company'])->name('delete_company');
Route::post('/get_parent_account_ajax', [App\Http\Controllers\AccountsController::class, 'get_parent_account_ajax'])->name('get_parent_account_ajax');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
