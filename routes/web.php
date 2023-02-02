<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\LogCallController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\FilesController;


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(UserController::class)->group(function () {

    Route::get('/profile', 'profile')->name('profile')->middleware('auth');
    Route::post('/update-profile', 'update_profile')->name('update_profile')->middleware('auth');

});

Route::controller(AccountsController::class)->group(function () {
    Route::get('/accounts', 'index')->name('accounts')->middleware('auth');
    Route::post('/add_account', 'add_account')->name('add_account')->middleware('auth');
    Route::match(['post', 'get'], '/account/{id}', 'edit_account')->name('edit_account')->middleware('auth');
    Route::get('/delete_account/{id}', 'delete_account')->name('delete_account')->middleware('auth');
    Route::post('/get_parent_account_ajax', 'get_parent_account_ajax')->name('get_parent_account_ajax')->middleware('auth');
    Route::post('/send_email/{id}', 'send_email')->name('send_email')->middleware('auth');
    Route::get('/delete_email/{email_id}/{account_id}', 'delete_email')->name('delete_email')->middleware('auth');
});

Route::controller(ContactsController::class)->group(function () {
    Route::get('/contacts','index')->name('contacts')->middleware('auth');
    Route::post('/add_contact', 'add_contact')->name('add_contact')->middleware('auth');
    Route::match(['post', 'get'],'/contact/{id}', 'edit_contact')->name('edit_contact')->middleware('auth');
    Route::get('/delete_contact/{id}', 'delete_contact')->name('delete_contact')->middleware('auth');
    Route::get('/contacts/{id}/account', 'contacts_by_account')->name('contacts_by_account')->middleware('auth');
});

Route::controller(CompaniesController::class)->group(function () {
    Route::get('/companies','index')->name('companies')->middleware('auth');
    Route::post('/create_company', 'store')->name('create_company')->middleware('auth');
    Route::post('/update-company/{id}', 'update')->name('edit-company')->middleware('auth');
    Route::get('/company/{id}', 'edit')->name('edit_company')->middleware('auth');
    Route::get('/destroy_company/{id}', 'destroy')->name('destroy_company')->middleware('auth');
    Route::get('/companies/{id}/account', 'companies_by_account')->name('companies_by_account')->middleware('auth');
});

Route::controller(LogCallController::class)->group(function () {
    Route::get('/log-call/{id}/{url}', 'get_call')->name('log_call')->middleware('auth');
    Route::post('/add_log_call','add_log_call')->name('add_log_call')->middleware('auth');
    Route::post('/edit_call/{id}', 'edit_call')->name('edit_call')->middleware('auth');
    Route::get('/delete_call/{id}/{url}', 'delete_call')->name('delete_call')->middleware('auth');
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/task/{id}/{url}', 'get_task')->name('task')->middleware('auth');
    Route::post('/add_task','add_task')->name('add_task')->middleware('auth');
    Route::post('/edit_task/{id}', 'edit_task')->name('edit_task')->middleware('auth');
    Route::get('/delete_task/{id}/{url}', 'delete_task')->name('delete_task')->middleware('auth');
});

Route::controller(EventController::class)->group(function () {
    Route::get('/event/{id}/{url}', 'get_event')->name('event')->middleware('auth');
    Route::post('/add_event','add_event')->name('add_event')->middleware('auth');
    Route::post('/edit_event/{id}', 'edit_event')->name('edit_event')->middleware('auth');
    Route::get('/delete_event/{id}/{url}', 'delete_event')->name('delete_event')->middleware('auth');
});

Route::controller(NotesController::class)->group(function () {
    Route::post('/add_notes','add_notes')->name('add_notes')->middleware('auth');
    Route::post('/edit_notes/{id}', 'edit_notes')->name('edit_notes')->middleware('auth');
    Route::get('/delete_notes/{id}', 'delete_notes')->name('delete_notes')->middleware('auth');
    Route::get('/{url}/{id}/notes', 'get_notes')->name('notes')->middleware('auth');
});

Route::controller(FilesController::class)->group(function () {
    Route::post('/add_files','add_files')->name('add_files')->middleware('auth');
    // Route::post('/edit_files/{id}', 'edit_files')->name('edit_files')->middleware('auth');
    Route::post('/edit_files', 'edit_files')->name('edit_files')->middleware('auth');
    Route::get('/delete_files/{id}', 'delete_files')->name('delete_files')->middleware('auth');
    Route::get('/{url}/{id}/files', 'get_files')->name('files')->middleware('auth');
    Route::post('/search_file', 'search_file')->name('search_file')->middleware('auth');
});

Route::controller(SendEmailController::class)->group(function () {
    Route::post('/send_email', 'send_email')->name('send_email')->middleware('auth');
    Route::get('/delete_email/{email_id}/', 'delete_email')->name('delete_email')->middleware('auth');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
