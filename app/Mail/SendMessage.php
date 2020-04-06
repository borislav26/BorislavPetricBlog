<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMessage extends Mailable
{
    use Queueable, SerializesModels;
    
protected $name;
protected $email;
protected $emailContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$emailContent){
        $this->name=$name;
        $this->email=$email;
        $this->emailContent=$emailContent;
    }
   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from($this->email, $this->name)
                ->replyTo($this->email)
                ->subject('You received message from blog!');
        return $this->view('front.email.email_content',[
            'name'=>$this->name,
            'content'=> $this->emailContent,
            'email'=> $this->email
        ]);
    }
}
