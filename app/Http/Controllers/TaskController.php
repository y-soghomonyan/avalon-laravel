<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Auth;

class TaskController extends Controller
{
    public function add_task(Request $req){
        $url = url()->previous();
        if(empty($req->input('contact_id')) || $req->input('contact_id') == 0){
            return redirect()->to($url)->with('danger',  'You need add New Contact');
        }
        $data = new Task();
        $data->contact_id = $req->input('contact_id');
        $data->company_id = $req->input('company_id');
        $data->subject = $req->input('subject');
        $data->related_to = $req->input('related_to');
        $data->assigned_to = $req->input('assigned_to');
        $data->priority = 1;
        $data->status = 1; 
        $data->reminder_set = 0; 
        $data->create_recurring_series_of_tasks = 0; 
        $data->date = $req->input('date'); 
        $data->user_id = Auth::user()->id;

        if ($data->save()) {
            return redirect()->to($url)->with('success',  'Add Task');
        }
    }

    public function edit_task(Request $req, $id){

        $url = url()->previous();
        $task = Task::whereId($id)->first();
        $task->contact_id = $req->input('contact_id');
        $task->company_id = $req->input('company_id');
        $task->subject = $req->input('subject');
        $task->comments = $req->input('comments');
        $task->related_to = $req->input('related_to');
        $task->assigned_to = $req->input('assigned_to');
        $task->priority =  $req->input('priority');
        $task->status =  $req->input('status');
        $task->reminder_set = $req->input('reminder_set');
        $task->create_recurring_series_of_tasks =  $req->input('create_recurring_series_of_tasks');
        $task->date =  $req->input('date');
        $task->user_id = Auth::user()->id;

        if ($task->save()) {
            return redirect()->to($url)->with('success',  'Edit Task');
        }
    }

    public function delete_task ($id){
        $url = url()->previous();
        $task = Task::find($id);
        if(empty($task)){
            return  redirect()->to($url)->with('danger', "Not Found");
        }
        if($task->delete()){
            return redirect()->to($url)->with('success',  ' Task Delete ');
        }
    }

}
