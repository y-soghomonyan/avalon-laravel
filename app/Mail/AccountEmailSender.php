<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;

class AccountEmailSender extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        //
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(/*$from, $subject, $to, $Bcc, $content*/)
    {
//        return $this->from($from, 'Example')
//            ->text($content)
//            ->view('emails.orders.shipped');
// dd($this->mailData['from']);


        return  $this->view('emails.demoMail')
        ->from($this->mailData['from'], 'test');;
    }

}
