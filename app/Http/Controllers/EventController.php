<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Auth;

class EventController extends Controller
{
    //

    public function add_event(Request $req){

        $url = url()->previous();
        if(empty($req->input('contact_id')) || $req->input('contact_id') == 0){
            return redirect()->to($url)->with('danger',  'You need add New Contact');
        }
        $data = new Event();
        $data->user_id = Auth::user()->id;
        $data->contact_id = $req->input('contact_id');
        $data->company_id = $req->input('company_id');
        $data->subject = $req->input('subject');
        $data->description = $req->input('description');
        $data->related_to = $req->input('related_to');
        $data->location = $req->input('location');
        $data->start_date = $req->input('start_date');
        $data->start_time = $req->input('start_time');
        $data->end_date = $req->input('end_date');
        $data->end_time = $req->input('end_time');
        $data->assigned_to = Auth::user()->id; 
        $data->date = $req->input('end_date').' '.$req->input('end_time'); 
        $data->type = 0; 
        $data->reminder_set = 0; 
        $data->full_day_event = 0; 

        if ($data->save()) {
           
            return redirect()->to($url)->with('success',  'Add Event');
           // return redirect()->route($req->input('url'), [$req->input('id')])->with('success',  ' Add ');
        }
        
    }


    public function edit_event(Request $req, $id){

        //dd($req);

        $url = url()->previous();
        $event = Event::whereId($id)->first();

        $event->user_id = Auth::user()->id;
        $event->contact_id = $req->input('contact_id');
      
        $event->company_id = $req->input('company_id');
        
        $event->subject = $req->input('subject');
        $event->description = $req->input('description');
        $event->related_to = $req->input('related_to');
        $event->location = $req->input('location');
        $event->start_date = $req->input('start_date');
        $event->start_time = $req->input('start_time');
        $event->end_date = $req->input('end_date');
        $event->end_time = $req->input('end_time');
        $event->assigned_to =  $req->input('assigned_to');
        $event->type =  $req->input('priority');
        $event->reminder_set = $req->input('reminder_set');
        $event->full_day_event = $req->input('full_day_event');
        $event->date = $req->input('end_date').' '.$req->input('end_time'); 
        // dd($req->input('company_id'));
        $event->user_id = Auth::user()->id;

        if ($event->save()) {
            return redirect()->to($url)->with('success',  'Edit Event');
            //return redirect()->route($req->input('url'), [$req->input('id')])->with('success',  ' Add ');
        }
    }

    public function delete_event ($id){
        $url = url()->previous();
        $event = Event::find($id);
        if(empty($event)){
            return  redirect()->to($url)->with('danger', "Not Found");
        }
        if($event->delete()){
            return redirect()->to($url)->with('success',  ' Event Delete ');
        }
    }
}
