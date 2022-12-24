<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyOrganizationsController;
use App\Http\Controllers\ContactsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(CompanyOrganizationsController::class)->group(function () {
    Route::get('/companies','index')->name('companies')->middleware('auth');
    Route::post('/add_account', 'add_account')->name('add_account')->middleware('auth');
    Route::match(['post', 'get'],'/edit-company/{id}', 'edit_company')->name('edit_company')->middleware('auth');
    Route::get('/delete_company/{id}', 'delete_company')->name('delete_company')->middleware('auth');
    Route::post('/get_parent_account_ajax','get_parent_account_ajax')->name('get_parent_account_ajax')->middleware('auth');
});


Route::controller(ContactsController::class)->group(function () {
    Route::get('/contacts','index')->name('contacts')->middleware('auth');
    Route::post('/add_contact', 'add_contact')->name('add_contact')->middleware('auth');
    Route::match(['post', 'get'],'/edit-contact/{id}', 'edit_contact')->name('edit_contact')->middleware('auth');
    Route::get('/delete_contact/{id}', 'delete_contact')->name('delete_contact')->middleware('auth');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
