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
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\CorporateAppointments;
use App\Http\Controllers\AddressProviderController;
use App\Http\Controllers\TaxReturnController;
use App\Http\Controllers\TestEmailController;
use App\Http\Controllers\PDFController;


Route::controller(TestEmailController::class)->group(function () {

    Route::get('/test', 'index')->name('test');
    
    Route::get('/create-email', 'create_email')->name('create_email');
    Route::get('/emails', 'all_emails')->name('all_emails');
    Route::get('/email', 'email')->name('email');
    Route::post('/delete_mailbox_email', 'delete_email')->name('delete_mailbox_email');
//    Route::post('/update-profile', 'update_profile')->name('update_profile');

});

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::controller(PDFController::class)->group(function () {

    // Route::get('pdfview',array('as'=>'pdfview','uses'=>'pdfview'));
    Route::get('/pdfview', 'pdfview')->name('pdfview')->middleware('auth');
    Route::get('/create_pdf', 'create_pdf')->name('create_pdf')->middleware('auth');
    Route::get('/pdf2', 'pdf2')->name('pdf2')->middleware('auth');
    
    Route::post('/edit_pdf', 'edit_pdf')->name('edit_pdf')->middleware('auth');

    
    
    


    // Route::post('/pdfview', 'pdfview')->name('pdfview')->middleware('auth');

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(UserController::class)->group(function () {

    Route::get('/profile', 'profile')->name('profile')->middleware('auth');
    Route::post('/update-profile', 'update_profile')->name('update_profile')->middleware('auth');

});

Route::controller(AddressProviderController::class)->group(function () {
    Route::get('/address-providers','index')->name('address_providers')->middleware('auth');
    Route::post('/add_address_providers', 'add_address_providers')->name('add_address_providers')->middleware('auth');
    Route::post('/update_address_provider', 'update')->name('update_address_provider')->middleware('auth');
    Route::get('/delete_address_provider/{id}', 'delete_address_provider')->name('delete_address_provider')->middleware('auth');
});

Route::controller(CorporateAppointments::class)->group(function () {
    Route::get('/corporate-appointments','index')->name('corporate_appointments')->middleware('auth');
    Route::post('/add_corporate_appointments', 'add_corporate_appointments')->name('add_corporate_appointments')->middleware('auth');
    Route::post('/update_corporate_appointments', 'update')->name('update_corporate_appointments')->middleware('auth');
    Route::get('/delete_corporate_appointments/{id}', 'delete_corporate_appointments')->name('delete_corporate_appointments')->middleware('auth');
});

Route::controller(AddressesController::class)->group(function () {
    Route::get('/addresses','index')->name('addresses')->middleware('auth');
    Route::post('/add_address', 'add_address')->name('add_address')->middleware('auth');
    Route::post('/update_address/{id}', 'update')->name('update_address')->middleware('auth');
    Route::get('/address/{id}', 'edit')->name('edit_address')->middleware('auth');
    Route::get('/delete_address/{id}', 'delete_address')->name('delete_address')->middleware('auth');
    Route::post('/get_states', 'get_states')->name('get_states')->middleware('auth');
    Route::post('/add_relation_address', 'add_relation_address')->name('add_relation_address')->middleware('auth');
    Route::post('/new_relation_address', 'new_relation_address')->name('new_relation_address')->middleware('auth');
    Route::get('/{url}/{id}/addresses', 'address_by_url')->name('address_by_url')->middleware('auth');
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
    Route::post('/uploade_file_company', 'uploade_file_company')->name('uploade_file_company')->middleware('auth');
    Route::post('/update_file_company', 'update_file_company')->name('update_file_company')->middleware('auth');
    Route::post('/create_tax_returns', 'create_tax_returns')->name('create_tax_returns')->middleware('auth');
    Route::post('/create_tax_returnspull2', 'create_tax_returnspull2')->name('create_tax_returnspull2')->middleware('auth');
    Route::get('/delete_tax_returns/{id}', 'delete_tax_returns')->name('delete_tax_returns')->middleware('auth');
    
});

Route::controller(TaxReturnController::class)->group(function () {

    Route::post('/create_tax_returns', 'create_tax_returns')->name('create_tax_returns')->middleware('auth');
    Route::post('/create_tax_returnspull2', 'create_tax_returnspull2')->name('create_tax_returnspull2')->middleware('auth');
    Route::post('/edit_tax_returns', 'edit_tax_returns')->name('edit_tax_returns')->middleware('auth');
    Route::get('/delete_tax_returns/{id}', 'delete_tax_returns')->name('delete_tax_returns')->middleware('auth');
    Route::get('/{url}/{id}/tax-return', 'tax_returns_by_url')->name('tax_returns_by_url')->middleware('auth');
    
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
