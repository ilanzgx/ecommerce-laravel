<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordForget extends Mailable
{
    use Queueable, SerializesModels;
    protected $token;

    public function __construct($token){
        $this->token = $token;
    }

    public function build()
    {
        return $this->view('Mail.password_forget', [
            'token' => $this->token
        ])->subject('Mude sua senha');
    }
}
