<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AddressRelation;
use App\Models\AddressProvider;
use App\Models\CountryState;
use App\Models\CompanyType;
use App\Models\Address;
use App\Models\Account;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Country;
use App\Models\User;
use Auth;

class AddressesController extends Controller
{
    //

    public function index (){

        $user_id = Auth::user()->id;

        return view('user.address.index', [
           'addresses' => Address::where('user_id', $user_id)->with('addressProvider')->get(),
           'countries' => Country::all(),
           'stateis' => CountryState::all(),
           'address_providers' => AddressProvider::where('user_id', '=', Auth::user()->id)->get(),
        ]);

    }

    public function edit ($id){

        return view('user.address.edit_address', [
            'address' => Address::where('id', '=', $id) ->with('addressProvider')->get()->first(),
            'countries' => Country::all(),
            'stateis' => CountryState::all(),
            'address_providers' => AddressProvider::where('user_id', '=', Auth::user()->id)->get(),
         ]);
    }

    public function update (Request $req, $id){
        $url = url()->previous();
        $address = Address::find($id);
        $address->title = $req->input('title');
        $address->country_id = $req->input('country_id');
        $address->state_id = $req->input('state_id');
        $address->city = $req->input('city');
        $address->address_provider  = $req->input('address_provider');
        $address->address_1 = $req->input('address_1');
        $address->address_2 = $req->input('address_2');
        $address->address_3 = $req->input('address_3');
        $address->post_code_zip = $req->input('post_code_zip');
        $address->user_id = Auth::user()->id;

        if( $address->save()){
            return redirect()->to($url)->with('success',  'Address is edited');
        }

    }

    public function delete_address ($id){

        $address = Address::find($id);
        if(empty($address)){
            return redirect()->route('addresses')->with('danger', "Not Found");
        }
        if($address->delete()){
            return redirect()->route('addresses')->with('success', $address->title.' - Removed');
        }
    }

    public function add_address(Request $req){

        $address = new Address();
  
        $address->title = $req->input('title');
        $address->country_id = $req->input('country_id');
        $address->state_id = $req->input('state_id');
        $address->city = $req->input('city');
        $address->address_provider  = $req->input('address_provider');
        $address->address_1 = $req->input('address_1');
        $address->address_2 = $req->input('address_2');
        $address->address_3 = $req->input('address_3');
        $address->post_code_zip = $req->input('post_code_zip');
        $address->user_id = Auth::user()->id;
        
        if( $address->save()){
            return redirect()->route('addresses')->with('success', $req->input('address_provider').' - Added');
        }
    }

    public function get_states(Request $req){
        $states = CountryState::where('country_id', '=', $req->id)->get(['id', 'name','country_id']);
        if(!empty($states[0])){
            return response()->json(['code' => 200, 'msg' => $states]);
        }
        return response()->json(['code' => 400, 'msg' => 'No Data']);
    }


    public function add_relation_address(Request $req){
        $url = url()->previous();

        // if($req->input('address_provider')){
        //     $address = Address::find($req->input('address_id'));
        //     $address->address_provider = $req->input('address_provider');
        //     $address->save();
        // }

        $data_id =  $req->input('page_url').'_id';
        AddressRelation::where($data_id, '=', $req->input('page_id'))->update(["address_type" => null]);

        $address_relation = AddressRelation::where($data_id, '=', $req->input('page_id'))->where('address_id', '=', $req->input('address_id'))->get()->first();
        
        if(empty($address_relation)){
            $address_relation = new AddressRelation();
        }
        $address_relation->{$data_id} = $req->input('page_id');
        $address_relation->address_id = $req->input('address_id');
        $address_relation->address_type = $req->input('address_type');
        $address_relation->provider_id = $req->input('address_provider');
        $address_relation->user_id = Auth::user()->id;

        if($address_relation->save()){
            return redirect()->to($url)->with('success',  'Main address is edited');
        }
        return redirect()->to($url)->with('danger',  'Address some error');
     }

     public function new_relation_address(Request $req){

        $url = url()->previous();

        $data_id =  $req->input('page_url').'_id';
        if($req->input('address_type')){
            AddressRelation::where($data_id, '=', $req->input('page_id'))->update(["address_type" => null]);
        }

        $address_relation = new AddressRelation();
      
        $address_relation->{$data_id} = $req->input('page_id');
        $address_relation->address_id = $req->input('address_id');
        $address_relation->address_type = $req->input('address_type');
        $address_relation->provider_id = $req->input('address_provider');

        if($address_relation->save()){
            return redirect()->to($url)->with('success',  'Main address is created');
        }
        return redirect()->to($url)->with('danger',  'Address some error');

     }

     public function address_by_url($url, $id){
         $user_id = Auth::user()->id;
         return view('user.address.by_page', [
             'addresses' => AddressRelation::where('user_id', $user_id)->where($url."_id", $id)->with('addresses.addressProvider')->get(),
             'countries' => Country::all(),
             'stateis' => CountryState::all(),
             'address_providers' => AddressProvider::where('user_id', '=', Auth::user()->id)->get(),
             'url' => $url,
             'id' => $id
         ]);
     }

    //  public function add_relation_address(Request $req){
    //     $data_id =  $req->input('page_url').'_id';
    //     $address_relation = AddressRelation::where($data_id, '=', $req->input('page_id'))->get()->first();
    //     if(empty($address_relation)){
    //         $address_relation = new AddressRelation();
    //     }
       
    //     $address_relation->{$data_id} = $req->input('page_id');
    //     $address_relation->address_id = $req->input('address_id');
    //     $address_relation->address_type = $req->input('address_type');
    //     $address_relation->user_id = Auth::user()->id;

    //     if($address_relation->save()){
    //         return response()->json(['code' => 200, 'msg' => $address_relation]);
    //       }
    //       return response()->json(['code' => 400, 'msg' => 'No Data']);
    //  }

}
