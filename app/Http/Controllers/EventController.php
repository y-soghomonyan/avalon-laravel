<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Company;
use App\Models\FileReations;
use App\Models\Notes;
use App\Models\Files;
use Auth;

class EventController extends Controller
{
    //

    public function add_event(Request $req){

        $url = url()->previous();
//        if(empty($req->input('contact_id')) || $req->input('contact_id') == 0){
//            return redirect()->to($url)->with('danger',  'You need add New Contact');
//        }
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
           
            return redirect()->to($url)->with('success',  'New Event Created');
           // return redirect()->route($req->input('url'), [$req->input('id')])->with('success',  ' Add ');
        }
        
    }


    public function get_event($id, $url){

        $event = Event::where('id', '=', $id)->with('contacts')->with('account')->with('company')->get()->first();
        $url_ = url()->previous();
        if(empty($event)){
            return redirect()->to($url_)->with('error',  'Call is not found');
        }

        return view('notifications.event', [
            'accounts' => Account::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'companies' => Company::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '=', Auth::user()->id)->get(['id', 'title']),
            'users' => User::all(['id', 'first_name', 'last_name', 'email']),
            'subject_events' => [1 => 'Call', 2 => 'Email', 3 => 'Meeting', 4 => 'Send Letter/Quote', 5 => 'Other'],
            'event' => $event,
            'url' => $url,
            'id' => $id,
            'page_title' => $event->name,
            'notes' => Notes::where('event_id', '=', $id)->get(),
            'files' => FileReations::where('event_id', '=', $id)->where('status', '=', 1)->with('file')->get(),
            'files_data' => FileReations::where('user_id', '=', Auth::user()->id)->with('file')->get(),
        ]);
    }


    public function edit_event(Request $req, $id){

        //dd($req);

        $url = url()->previous();
        $event = Event::whereId($id)->first();


        $requests = [
            'contact_id',
            'company_id',
            'subject',
            'description',
            'related_to',
            'location',
            'start_date',
            'start_time',
            'end_date',
            'end_time',
            'full_day_event',
            'assigned_to',
            'type',
            'reminder_set',
    ];

        foreach ($requests as $request){
            if($req->input($request)){
                $event->{$request} = $req->input($request);
            }
        }

        // $event->user_id = Auth::user()->id;
        // $event->contact_id = $req->input('contact_id');
        // $event->company_id = $req->input('company_id');
        // $event->subject = $req->input('subject');
        // $event->description = $req->input('description');
        // $event->related_to = $req->input('related_to');
        // $event->location = $req->input('location');
        // $event->start_date = $req->input('start_date');
        // $event->start_time = $req->input('start_time');
        // $event->end_date = $req->input('end_date');
        // $event->end_time = $req->input('end_time');
        // $event->assigned_to =  $req->input('assigned_to');
        // $event->type =  $req->input('type');
        // $event->reminder_set = $req->input('reminder_set');
        // $event->full_day_event = $req->input('full_day_event');



        if($req->input('end_date') || $req->input('end_time')){
            $event->date = $req->input('end_date').' '.$req->input('end_time'); 
        }
        
        $event->user_id = Auth::user()->id;

        if ($event->save()) {
            return redirect()->to($url)->with('success',  'Event is edited');
        }
    }

    public function delete_event ($id, $url = null){

        $event = Event::find($id);
        $url_id  = '';
        if(!isset($url)){
            $url = url()->previous();
        }else{
            $key = $url.'_id';
            if($url == 'account'){
                $key = 'related_to';
            }
            $url_id = $event->{$key};
            $url = 'edit_'.$url;
        }

        
        if(empty($event)){
            if (!empty($url_id)){
                return redirect()->route($url, [$url_id])->with('danger', "Not Found");
            }
            return  redirect()->to($url)->with('danger', "Not Found");
        }
        if($event->delete()){
            if (!empty($url_id)){
                return redirect()->route($url, [$url_id])->with('success',  ' Event is Deleted ');
            }
            return redirect()->to($url)->with('success',  ' Event is Deleted ');
        }
    }
}
