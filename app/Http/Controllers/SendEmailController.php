<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AccountSendEmail;
use Auth;

class SendEmailController extends Controller
{

    public function send_email(Request $req){
        $url = url()->previous();

        $email =  new AccountSendEmail();

        $email->subject = $req->input('subject');
        $email->user_id = Auth::user()->id;
        $email->from = $req->input('from');
        $email->to = $req->input('to');
        $email->Bcc = $req->input('Bcc');
        $email->content = $req->input('content');
        $email->related_to = $req->input('related_to');

        if($email->save()){
       

        // foreach (['taylor@example.com', 'dries@example.com'] as $recipient) {
        //     Mail::to($recipient)->send(new OrderShipped($order));
        // }

        $mailData = [
            'from' => $req->input('from'),
            'title' => $req->input('subject'),
            'content' => $req->input('content'),
        ];
         
        Mail::to($req->input('to'))->bcc($req->input('Bcc'))->send(new AccountEmailSender($mailData));
        
        return redirect()->to($url)->with('success',  'Email sent');
        //return redirect()->route('edit_account', [$id])->with('success',  'Email send');
    }

           
        dd("Email is sent successfully.");

        // Mail::to($request->user())
        //     ->cc($moreUsers)
        //     ->bcc($evenMoreUsers)
        //     ->send(new OrderShipped($order));
        // dd($req);

    }


    public function delete_email($email_id){
        $email = AccountSendEmail::find($email_id);
        if(empty($email) || $email->account_id != $account_id){
            return redirect()->route('edit_account', [$account_id])->with('danger', "Email Not Found");
        }
        if($email->delete()){
            return redirect()->route('edit_account', [$account_id])->with('success', $email->subject.' - Remove');
        }
    }
}
