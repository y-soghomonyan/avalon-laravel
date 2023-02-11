<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\CorporateAppointment;
use App\Mail\AccountEmailSender;
use App\Models\AccountSendEmail;
use App\Models\AppointmentsRole;
use App\Models\AddressRelation;
use App\Models\AddressProvider;
use App\Models\IndustriesType;
use App\Models\FileReations;
use App\Models\CompanyType;
use App\Models\Address;
use App\Models\Account;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Notes;
use App\Models\Files;
use App\Models\User;
use Auth;

class AccountsController extends Controller
{

    public $months =  array(
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July ',
        'August',
        'September',
        'October',
        'November',
        'December',
    );

    public function index(){
        $id = Auth::user()->id;

        return view('user.account.accounts', [
            'account_types' => CompanyType::all(),
            'industries_types' => IndustriesType::all(),
            'accounts' => Account::where('user_id', $id)->get(),
            'all_accounts' =>Account::all( 'id', 'name' ),
            'users'=>User::all(['id', 'first_name', 'last_name']),
            ]);
    }

    public function add_account(Request $req){

        $data = new Account();

        $data->name = $req->input('name');
        $data->user_id = Auth::user()->id;
        $data->owner_id = $req->input('owner_id');
        $data->account_personality_type = $req->input('account_personality_type');
        $data->account_type_id = $req->input('account_type_id');
        $data->parent_id = $req->input('parent_id') ? $req->input('parent_id') : 0 ;
        $data->industry_id = $req->input('industry_id');
        $data->account_phone = $req->input('account_phone');
        $data->website = $req->input('website');
        $data->additional_phone = $req->input('additional_phone');
        $data->employees = $req->input('employees');
        $data->description = $req->input('description');
        $data->address_1_street = $req->input('address_1_street');
        $data->address_1_country = $req->input('address_1_country');
        $data->address_1_city = $req->input('address_1_city');
        $data->address_1_state = $req->input('address_1_state');
        $data->address_1_zip_code = $req->input('address_1_zip_code');
        $data->address_2_street = $req->input('address_2_street');
        $data->address_2_country = $req->input('address_2_country');
        $data->address_2_city = $req->input('address_2_city');
        $data->address_2_state = $req->input('address_2_state');
        $data->address_2_zip_code = $req->input('address_2_zip_code');

        if($data->save()){
            return redirect()->route('accounts')->with('success', $req->input('name').' - Added');
        }
    }

    public function edit_account(Request $req, $id){
        $account = Account::whereId($id)->withCount('contacts')->first();

        if(empty($account)){
            return redirect()->route('accounts')->with('danger', "Not Found");
        }

        if ($_POST){
            if($account->user_id == Auth::user()->id) {
                $account->name = $req->input('name');
                $account->user_id = Auth::user()->id;
                $account->account_personality_type = $req->input('account_personality_type');
                $account->owner_id = $req->input('owner_id');
                $account->account_type_id = $req->input('account_type_id');
                $account->parent_id = $req->input('parent_id') ? $req->input('parent_id') : 0;
                $account->industry_id = $req->input('industry_id');
                $account->account_phone = $req->input('account_phone');
                $account->website = $req->input('website');
                $account->additional_phone = $req->input('additional_phone');
                $account->employees = $req->input('employees');
                $account->description = $req->input('description');
                $account->address_1_street = $req->input('address_1_street');
                $account->address_1_country = $req->input('address_1_country');
                $account->address_1_city = $req->input('address_1_city');
                $account->address_1_state = $req->input('address_1_state');
                $account->address_1_zip_code = $req->input('address_1_zip_code');
                $account->address_2_street = $req->input('address_2_street');
                $account->address_2_country = $req->input('address_2_country');
                $account->address_2_city = $req->input('address_2_city');
                $account->address_2_state = $req->input('address_2_state');
                $account->address_2_zip_code = $req->input('address_2_zip_code');

                if ($account->save()) {
                    return redirect()->route('edit_account', [$id])->with('success', $req->input('name') . ' - Edited');
                }
            }
        }

        $notifications = new NotificationController;
    
        return view('user.account.edit_account', [
            'company_types' => CompanyType::all(),
            'industries_types' => IndustriesType::all(),
            'account' => $account,
            'accounts' => Account::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'users' => User::all(['id', 'first_name', 'last_name', 'email']),
            'companies' => Company::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '=', Auth::user()->id)->get(['id', 'title']),
            'countries' => Country::all(),
            'companies_count' => Company::where('user_id', '=', Auth::user()->id)->where('account_id', '=', $id)->get(['id', 'name']),
            'contacts_count' => Contact::where('user_id', '=', Auth::user()->id)->where('account_id', '=', $id)->get(['id', 'title']),
            'emails' => AccountSendEmail::where('user_id', '=', Auth::user()->id)->get(),
            'notifications' => $notifications->notifications('related_to',$id),
            'upcoming_overdues' => $notifications->UpcomingOverdue('related_to',$id),
            'subject_events' => [1 => 'Call', 2 => 'Email', 3 => 'Meeting', 4 => 'Send Letter/Quote', 5 => 'Other'],
            'subject_tasks' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'subject_calls' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'url' => 'account',
            'id' => $id,
            'page_title' => $account->name,
            'notes' => Notes::where('account_id', '=', $id)->get(),
            'files' => FileReations::where('account_id', '=', $id)->where('status', '=', 1)->with('file')->get(),
            'files_data' => FileReations::where('user_id', '=', Auth::user()->id)->with('file')->get(),
            'addresses' => Address::where('user_id', '=', Auth::user()->id)
            ->with('country')
            ->with('state')
            ->with('addressRelation')
            ->whereHas('addressRelation', function($q) use($id){$q->where('account_id', $id);})->get(),
            'all_addresses' => Address::where('user_id', '=', Auth::user()->id)->with('country')->with('state')->with('addressRelation')->get(),

            'corporate_appointments' => CorporateAppointment::where('user_id', '=', Auth::user()->id)->where('account_id', '=', $id)->with('roles')->get(),
            'appointments_roles' => AppointmentsRole::all(),
            'address_providers' => AddressProvider::where('user_id', '=', Auth::user()->id)->get(),
            'months' => $this->months,
        ]);
    }


    public function delete_account($id){
        $account = Account::find($id);
        if(empty($account)){
            return redirect()->route('accounts')->with('danger', "Not Found");
        }
        if($account->delete()){
            return redirect()->route('accounts')->with('success', $account->name.' - Removed');
        }
    }




    public function get_parent_account_ajax (Request $req){
        if($req->ajax()){
            $account = Account::query()->where('name', 'like', '%'. $req->parent_account .'%')->get();
            return  $account;
        }
    }



   
}
