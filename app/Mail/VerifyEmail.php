<?php

namespace App\Mail;

use App\Models\User as ModelsUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use SendGrid\Mail\Mail;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(ModelsUser $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $verificationUrl = $this->verificationUrl;

        $email = new Mail();
        $email->setFrom(config('tccprojeto395@gmail.com'), config('Street Slang'));
        $email->addTo($this->user->email, $this->user->name);
        $email->setSubject('Verify your email address');
        $email->addContent(
            "text/html",
            view('auth.verify-email', compact('verificationUrl'))->render()
        );

        return $email;
    }
}
