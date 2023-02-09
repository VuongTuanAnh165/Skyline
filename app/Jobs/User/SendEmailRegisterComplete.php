<?php

namespace App\Jobs\User;

use App\Mail\User\MailRegisterComplete;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailRegisterComplete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $code;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$code)
    {
        $this->data = $data;
        $this->code = $code;

    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \SendGrid\Mail\TypeException
     */
    public function handle()
    {
        $emailSend = $this->data;
        $contentEmail = new MailRegisterComplete($this->code);
        Mail::to($emailSend)->send($contentEmail);
    }
}
