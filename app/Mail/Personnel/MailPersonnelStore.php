<?php

namespace App\Mail\Personnel;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailPersonnelStore extends Mailable
{
    use Queueable, SerializesModels;

    protected $pathView = 'restaurant.admin.personnel.email.';
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
            ->subject(config('mail.subject.personnel_password_store'))
            ->view($this->pathView.'password_store', ['code' => $this->code]);
    }
}
