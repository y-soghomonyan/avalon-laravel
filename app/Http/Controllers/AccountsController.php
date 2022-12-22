<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyTypes;
use App\Models\IndustriesTypes;
use App\Models\Companies;
use Auth;

class AccountsController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $companies = new Companies;

        $company_types = new CompanyTypes;

        $industries_types = new IndustriesTypes;

        return view('user/accounts', ['company_types' => CompanyTypes::all(), 'industries_types' => IndustriesTypes::all(), 'companies' => Companies::where('user_id', $id)->get()]);
    }

    public function add_account(Request $req){

        $data = new Companies();

        $data->name = $req->input('name');
        $data->user_id = Auth::user()->id;
        $data->company_type = 1;//$req->input('company_type');
        $data->company_id = $req->input('company_id');
        $data->parent_id = 1;//$req->input('parent_id');
        $data->industry_id = $req->input('industry_id');
        $data->account_phone = $req->input('account_phone');
        $data->website = $req->input('website');
        $data->additional_phone = $req->input('additional_phone');
        $data->employees = $req->input('employees');
        $data->description = $req->input('description');
        $data->biling_street = $req->input('billing_street');
        $data->biling_country = $req->input('billing_country');
        $data->biling_city = $req->input('billing_city');
        $data->biling_state = $req->input('billing_state');
        $data->biling_zip_code = $req->input('billing_zip_code');
        $data->shipping_street = $req->input('shipping_street');
        $data->shipping_country = $req->input('shipping_country');
        $data->shipping_city = $req->input('shipping_city');
        $data->shipping_state = $req->input('shipping_state');
        $data->shipping_zip_code = $req->input('shipping_zip_code');

        
        if($data->save()){
            return redirect()->route('accounts')->with('success', $req->input('name').' - Add');

        }
      

        dd($req);

    }

    public function get_parent_account_ajax (Request $req) {
      
        if($req->ajax()){
           $data = Companies::query()->where('name', 'like', '%'. $req->parent_account .'%')->get();
            return  $data;
        }
    }
}
