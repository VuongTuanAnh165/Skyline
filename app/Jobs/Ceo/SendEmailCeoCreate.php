<?php

namespace App\Jobs\Ceo;

use App\Mail\Ceo\MailCeoCreate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailCeoCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $email;
    protected $code;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $email ,$code)
    {
        $this->data = $data;
        $this->email = $email;
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
        $emailSend = $this->email;
        $contentEmail = new MailCeoCreate($this->data,$this->code);
        Mail::to($emailSend)->send($contentEmail);
    }
}
