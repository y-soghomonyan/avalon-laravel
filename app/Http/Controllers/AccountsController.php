<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyTypes;
use App\Models\IndustriesTypes;
use App\Models\Companies;
use App\Models\User;
use Auth;

class AccountsController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $companies = new Companies;
        $company_types = new CompanyTypes;
        $industries_types = new IndustriesTypes;
        $users = new User;

        return view('user/accounts', [
            'company_types' => CompanyTypes::all(),
            'industries_types' => IndustriesTypes::all(),
            'companies' => Companies::where('user_id', $id)->get(),
            'all_companies' =>Companies::all( 'id', 'name' ),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'name']),
            ]);
    }

    public function add_account(Request $req){

        $data = new Companies();

       //dd($req);

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
            return redirect()->route('accounts')->with('success', $req->input('name').' - Add');
        }
    }

    public function edit_account(Request $req, $id){
        $data = Companies::find($id);

        if($data->user_id == Auth::user()->id){
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
                return redirect()->route('accounts')->with('success', $req->input('name').' - Edit');
            }
        }
    }

    public function get_parent_account_ajax (Request $req) {
        if($req->ajax()){
           $data = Companies::query()->where('name', 'like', '%'. $req->parent_account .'%')->get();
            return  $data;
        }
    }
}
