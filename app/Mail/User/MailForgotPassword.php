<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $pathView = 'api.email.user.';
    /**
     * @var $code
     */
    protected $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME', 'laravel@gmail.com'))
            ->subject(config('mail.subject.forgot'))
            ->view($this->pathView.'forgot_password', ['code' => $this->code]);
    }
}
