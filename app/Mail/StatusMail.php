<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StatusMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject;
    public $message;
    public $attach;
    public $name;
    public function __construct($subject, $message, $name, $attach = [])
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->attach = $attach;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.message')
                    ->subject($this->subject)
                    ->with([
                        'msg' => $this->message,
                        'name' => $this->name,
                    ]);
        if($this->attach) {
            foreach ($this->attach as $value) {
                $fp = storage_path('app/public/attach/'.$value);
                    $email->attach($fp);
            }
        }
        return $email;
    }
}
