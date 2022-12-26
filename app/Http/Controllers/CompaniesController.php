<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyOrganization;
use App\Models\CompanyType;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Country;
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
            'company_types' => CompanyType::all(),
            'companies' => Company::where('user_id', $id)->get(),
            'countries' => Country::with(['states'])->get(),
            'company_organizations' => CompanyOrganization::where('user_id', '!=', $id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '!=', $id)->get(['id', 'title']),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'name']),
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
//dd($request);
        $company = new Company();

        $company->user_id = Auth::user()->id;
        $company->name = $request->input('name');
        $company->filing = $request->input('filing');
        $company->state_id = $request->input('state_id');
        $company->company_id = $request->input('company_id');
        $company->country_id = $request->input('country_id');

        $company->filing_status = $request->input('filing_status');
        $company->company_organization_id = $request->input('company_organization_id');
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

        if($company->save()){
            return redirect()->route('companies')->with('success', $request->input('name').' - Add');
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

        return view('user.company.edit', [
            'company' => $company,
            'company_types' => CompanyType::all(),
            'countries' => Country::with(['states'])->get(),
            'company_organizations' => CompanyOrganization::where('user_id', '!=', $id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '!=', $id)->get(['id', 'title']),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'name']),
        ]);

        //
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
            $company->company_organization_id = $request->input('company_organization_id');
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

            if($company->save()){
                return redirect()->route('edit-company', [$id])->with('success', $request->input('name') . ' - Edit');

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
            return redirect()->route('companies')->with('success', $data->name.' - Remove');
        }
    }
}
