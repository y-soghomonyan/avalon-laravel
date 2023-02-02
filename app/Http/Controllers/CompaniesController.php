<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountSendEmail;
use App\Models\TypeOfCompaneis;
use App\Models\FileReations;
use App\Models\CompanyType;
use App\Models\Account;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Files;
use App\Models\Notes;
use App\Models\User;
use Auth;


class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        return view('user.company.index', [
            'company_types' => TypeOfCompaneis::all(),
            'companies' => Company::where('user_id', $id)->get(),
            'countries' => Country::with(['states'])->get(),
            'accounts' => Account::where('user_id', '=', $id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '=', $id)->get(['id', 'title']),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'first_name', 'last_name']),
        ]);
    }

    public function companies_by_account($id)
    {
        $user_id = Auth::user()->id;
        return view('user.company.index', [
            'company_types' => TypeOfCompaneis::all(),
            'companies' => Company::where('account_id', $id)->get(),
            'countries' => Country::with(['states'])->get(),
            'accounts' => Account::where('user_id', '=', $user_id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '=', $user_id)->get(['id', 'title']),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'first_name', 'last_name']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new Company();

        $company->user_id = Auth::user()->id;
        $company->type = $request->input('type');
        $company->name = $request->input('name');
        $company->status = $request->input('status');
        $company->filing = $request->input('filing');
        $company->state_id = $request->input('state_id');
        $company->division = $request->input('division');
        $company->company_id = $request->input('company_id');
        $company->country_id = $request->input('country_id');
        $company->sub_status = $request->input('sub_status');
        $company->account_id = $request->input('account_id');
        $company->contact_id = $request->input('contact_id');
        $company->filing_status = $request->input('filing_status');
        $company->previous_name1 = $request->input('previous_name1');
        $company->previous_name2 = $request->input('previous_name2');
        $company->previous_name3 = $request->input('previous_name3');
        $company->previous_name4 = $request->input('previous_name4');
        $company->previous_name5 = $request->input('previous_name5');
        $company->incorporation_date = $request->input('incorporation_date');

        if($company->save()){
            return redirect()->route('companies')->with('success', $request->input('name').' - Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        if(empty($company)){
            return redirect()->route('companies')->with('danger', "Not Found");
        }
        $notifications = new NotificationController;
        return view('user.company.edit', [
            'company' => $company,
            'company_types' => TypeOfCompaneis::all(),
            'countries' => Country::with(['states'])->get(),
            'accounts' => Account::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '=', Auth::user()->id)->get(['id', 'title']),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'email', 'first_name', 'last_name']),
            'companies' =>Company::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'companies_count' => Company::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts_count' => Contact::where('user_id', '=', Auth::user()->id)->get(['id', 'title']),
            'emails' => AccountSendEmail::where('user_id', '=', Auth::user()->id)->get(),
            'notifications'=> $notifications->notifications('company_id',$id),
            'upcoming_overdues' => $notifications->UpcomingOverdue('company_id',$id),
            'subject_events' => [1 => 'Call', 2 => 'Email', 3 => 'Meeting', 4 => 'Send Letter/Quote', 5 => 'Other'],
            'subject_tasks' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'subject_calls' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'url' => 'company',
            'id' => $id,
            'page_title' => $company->name,
            'notes' => Notes::where('company_id', '=', $id)->get(),
            'files' => FileReations::where('company_id', '=', $id)->where('status', '=', 1)->with('file')->get(),
            'files_data' => FileReations::where('user_id', '=', Auth::user()->id)->with('file')->get(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $company = Company::find($id);

        if(empty($company)){
            return redirect()->route('companies')->with('danger', "Not Found");
        }

        if($company->user_id == Auth::user()->id){
            $company->name = $request->input('name');
            $company->filing = $request->input('filing');
            $company->state_id = $request->input('state_id');
            $company->company_id = $request->input('company_id');
            $company->country_id = $request->input('country_id');
            $company->filing_status = $request->input('filing_status');
            $company->account_id = $request->input('account_id');
            $company->contact_id = $request->input('contact_id');
            $company->type = $request->input('type');
            $company->division = $request->input('division');
            $company->status = $request->input('status');
            $company->sub_status = $request->input('sub_status');
            $company->previous_name1 = $request->input('previous_name1');
            $company->previous_name2 = $request->input('previous_name2');
            $company->previous_name3 = $request->input('previous_name3');
            $company->previous_name4 = $request->input('previous_name4');
            $company->previous_name5 = $request->input('previous_name5');
            $company->incorporation_date = $request->input('incorporation_date');

            if($company->save()){
                return redirect()->route('edit_company', [$id])->with('success', $request->input('name') . ' - Edited');
            }
        }
        return redirect()->route('companies')->with('error', $request->input('name').' - is not your');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Company::find($id);
        if(empty($data)){
            return redirect()->route('companies')->with('danger', "Not Found");
        }
        if($data->delete()){
            return redirect()->route('companies')->with('success', $data->name.' - Removed');
        }
    }
}
