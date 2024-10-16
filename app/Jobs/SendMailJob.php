<?php

namespace App\Jobs;

use App\Mail\ApproveUser;
use App\Mail\RegistrationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $mailData, $sendEmailId, $mailType;

    /**
     * Create a new job instance.
     */
    public function __construct($mailData, $sendEmailId, $mailType)
    {
        $this->mailData = $mailData;
        $this->sendEmailId = $sendEmailId;
        $this->mailType = $mailType;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ('registration' === $this->mailType) {
            Mail::to($this->sendEmailId)->send(new RegistrationMail($this->mailData));
        } elseif ('userApprove' === $this->mailType) {
            Mail::to($this->sendEmailId)->send(new ApproveUser($this->mailData));
        }
    }
}
