<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LogCall;
use Auth;

class LogCallController extends Controller
{
    //

    public function add_log_call(Request $req){
        $url = url()->previous();
//        dd($url);
//        if(empty($req->input('contact_id')) || $req->input('contact_id') == 0){
//            return redirect()->to($url)->with('danger',  'You need add New Contact');
//        }
        $data = new LogCall();
        $data->contact_id = $req->input('contact_id');
        $data->company_id = $req->input('company_id');
        $data->subject = $req->input('subject');
        $data->comments = $req->input('comments');
        $data->related_to = $req->input('related_to');
        $data->assigned_to = Auth::user()->id; 
        $data->priority = 1; 
        $data->status = 1; 
        $data->reminder_set = 0; 
        $data->create_recurring_series_of_tasks = 0; 
        $data->date = date('Y-m-d'); 
        $data->user_id = Auth::user()->id;

        if ($data->save()) {
            return redirect()->to($url)->with('success',  'Call is added');
           // return redirect()->route($req->input('url'), [$req->input('id')])->with('success',  ' Add ');
        }
    }


    public function edit_call(Request $req, $id){

        $url = url()->previous();
        $call = LogCall::whereId($id)->first();
        $call->contact_id = $req->input('contact_id');
        $call->company_id = $req->input('company_id');
        $call->subject = $req->input('subject');
        $call->comments = $req->input('comments');
        $call->related_to = $req->input('related_to');
        $call->assigned_to = $req->input('assigned_to');
        $call->priority =  $req->input('priority');
        $call->status =  $req->input('status');
        $call->reminder_set = $req->input('reminder_set');
        $call->create_recurring_series_of_tasks =  $req->input('create_recurring_series_of_tasks');
        $call->date =  $req->input('date');
        $call->user_id = Auth::user()->id;

        if ($call->save()) {
            return redirect()->to($url)->with('success',  'Call is edited');
            //return redirect()->route($req->input('url'), [$req->input('id')])->with('success',  ' Add ');
        }
    }

    public function delete_call ($id){
        $url = url()->previous();
        $call = LogCall::find($id);
        if(empty($call)){
            return  redirect()->to($url)->with('danger', "Not Found");
        }
        if($call->delete()){
            return redirect()->to($url)->with('success',  ' Call is Deleted ');
        }
    }


}
