<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyType;
use App\Models\IndustriesType;
use App\Models\Company;
use App\Models\User;
use Auth;

class CompanyOrganizationsController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
//        $companies = new Companies;
//        $company_types = new CompanyTypes;
//        $industries_types = new IndustriesTypes;
//        $users = new User;

        return view('user.company_organization.company_organizations', [
            'company_types' => CompanyType::all(),
            'industries_types' => IndustriesType::all(),
            'companies' => Company::where('user_id', $id)->get(),
            'all_companies' =>Company::all( 'id', 'name' ),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'name']),
            ]);
    }

    public function add_account(Request $req){

        $data = new Company();

        $data->name = $req->input('name');
        $data->user_id = Auth::user()->id;
        $data->owner_id = $req->input('owner_id');
        $data->company_id = $req->input('company_id');
        $data->parent_id = $req->input('parent_id') !== "Select Parent Company" ? $req->input('parent_id') : 0 ;
        $data->industry_id = $req->input('industry_id');
        $data->company_phone = $req->input('company_phone');
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
            return redirect()->route('companies')->with('success', $req->input('name').' - Add');
        }
    }

    public function edit_company(Request $req, $id){
        $company = Company::whereId($id)->withCount('contacts')->first();

        if ($_POST){
            if($company->user_id == Auth::user()->id) {
                $company->name = $req->input('name');
                $company->user_id = Auth::user()->id;
                $company->owner_id = $req->input('owner_id');
                $company->company_id = $req->input('company_id');
                $company->parent_id = $req->input('parent_id') !== "Select Parent Company" ? $req->input('parent_id') : 0;
                $company->industry_id = $req->input('industry_id');
                $company->company_phone = $req->input('company_phone');
                $company->website = $req->input('website');
                $company->additional_phone = $req->input('additional_phone');
                $company->employees = $req->input('employees');
                $company->description = $req->input('description');
                $company->address_1_street = $req->input('address_1_street');
                $company->address_1_country = $req->input('address_1_country');
                $company->address_1_city = $req->input('address_1_city');
                $company->address_1_state = $req->input('address_1_state');
                $company->address_1_zip_code = $req->input('address_1_zip_code');
                $company->address_2_street = $req->input('address_2_street');
                $company->address_2_country = $req->input('address_2_country');
                $company->address_2_city = $req->input('address_2_city');
                $company->address_2_state = $req->input('address_2_state');
                $company->address_2_zip_code = $req->input('address_2_zip_code');

                if ($company->save()) {
                    return redirect()->route('edit_company', [$id])->with('success', $req->input('name') . ' - Edit');
                }
            }
        }

        return view('user.company_organization.edit_company', [
            'company_types' => CompanyType::all(),
            'industries_types' => IndustriesType::all(),
            'company' => $company,
            'all_companies' =>Company::get(['id', 'name']),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'name']),
        ]);
    }

    public function delete_company($id){
        $company = Company::find($id);
        if($company->delete()){
            return redirect()->route('companies')->with('success', $company->name.' - Remove');
        }
    }


    public function get_parent_account_ajax (Request $req) {
        if($req->ajax()){
            $company = Company::query()->where('name', 'like', '%'. $req->parent_account .'%')->get();
            return  $company;
        }
    }
}
