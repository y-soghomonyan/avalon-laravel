<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AccountSendEmail;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Company;
use App\Models\User;
use Auth;

class ContactsController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        return view('user.contact.contacts', [
            'contacts' => Contact::where('user_id', $id)->get(),
            'accounts' =>Account::all( 'id', 'name' ),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'name', 'email']),
        ]);
    }

    public function contacts_by_account($id){
        return view('user.contact.contacts', [
            'contacts' => Contact::where('account_id', $id)->get(),
            'accounts' =>Account::all( 'id', 'name' ),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'name', 'email']),
        ]);
    }

    public function add_contact(Request $req){

        $data = new Contact();

        $data->user_id = Auth::user()->id;
        $data->owner_id = $req->input('owner_id');
        $data->solution = $req->input('solution');
        $data->account_id = $req->input('account_id');
        $data->first_name = $req->input('first_name');
        $data->last_name = $req->input('last_name');
        $data->middle_name = $req->input('middle_name');
        $data->suffix = $req->input('suffix');
        $data->phone = $req->input('phone');
        $data->fax = $req->input('fax');
        $data->reports = $req->input('reports');
        $data->email = $req->input('email');
        $data->title = $req->input('title');
        $data->mobile = $req->input('mobile');
        $data->department = $req->input('department');
        $data->mailing_address = $req->input('mailing_address');
        $data->mailing_street = $req->input('mailing_street');
        $data->mailing_city = $req->input('mailing_city');
        $data->mailing_state = $req->input('mailing_state');
        $data->mailing_country = $req->input('mailing_country');
        $data->mailing__zip_code = $req->input('mailing__zip_code');

        if($data->save()){
            return redirect()->route('contacts')->with('success', $req->input('title').' - Add');
        }

    }

    public function edit_contact(Request $req, $id){
        $contact = Contact::find($id);

        if(empty($contact)){
            return redirect()->route('contacts')->with('danger', "Not Found");
        }

        if ($_POST){
            if($contact->user_id == Auth::user()->id) {

                $contact->user_id = Auth::user()->id;
                $contact->owner_id = $req->input('owner_id');
                $contact->solution = $req->input('solution') !== "0" ? $req->input('solution') : 0 ;
                $contact->account_id = $req->input('account_id');
                $contact->first_name = $req->input('first_name');
                $contact->last_name = $req->input('last_name');
                $contact->middle_name = $req->input('middle_name');
                $contact->suffix = $req->input('suffix');
                $contact->phone = $req->input('phone');
                $contact->fax = $req->input('fax');
                $contact->reports = $req->input('reports');
                $contact->email = $req->input('email');
                $contact->title = $req->input('title');
                $contact->mobile = $req->input('mobile');
                $contact->department = $req->input('department');
                $contact->mailing_address = $req->input('mailing_address');
                $contact->mailing_street = $req->input('mailing_street');
                $contact->mailing_city = $req->input('mailing_city');
                $contact->mailing_state = $req->input('mailing_state');
                $contact->mailing_country = $req->input('mailing_country');
                $contact->mailing__zip_code = $req->input('mailing__zip_code');

                if ($contact->save()) {
                    return redirect()->route('edit_contact', [$id])->with('success', $req->input('title') . ' - Edit');
                }
            }
        }
        $notifications = new NotificationController;

        return view('user.contact.edit_contact', [
            'contact' => $contact,
            'accounts' => Account::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'companies' =>Company::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '=', Auth::user()->id)->get(['id', 'title']),
            'users'=> User::where('id', '!=', Auth::user()->id)->get(['id', 'name','email']),
            'emails' => AccountSendEmail::where('user_id', '=', Auth::user()->id)->get(),
            'notifications'=> $notifications->notifications('contact_id',$id),
            'companies_count' => Company::where('user_id', '=', Auth::user()->id)->where('contact_id', '=', $id)->get(['id', 'name']),
            'contacts_count' => Contact::where('user_id', '=', Auth::user()->id)->get(['id', 'title']),
            'upcoming_overdues' => $notifications->UpcomingOverdue('contact_id',$id),
            'subject_events' => [1 => 'Call', 2 => 'Email', 3 => 'Meeting', 4 => 'Send Letter/Quote', 5 => 'Other'],
            'subject_tasks' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'subject_calls' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            
        ]);
    }

    public function delete_contact($id){
        $data = Contact::find($id);
        if(empty($data)){
            return redirect()->route('contacts')->with('danger', "Not Found");
        }
        if($data->delete()){
            return redirect()->route('contacts')->with('success', $data->title.' - Remove');
        }
    }
}
