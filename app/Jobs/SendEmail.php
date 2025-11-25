<?php

namespace App\Jobs;

use App\Mail\welcomeemail;
use App\Models\SendEmail as SendEmailModel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Exception;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $message;
    public $subject;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $message, $subject)
    {
        $this->user = $user;
        $this->message = $message;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Find the existing SendEmail record for this user
        // The command should have already created this record
        $emailRecord = SendEmailModel::where('user_id', $this->user->id)->first();
        
        // If for some reason it doesn't exist, create it
        if (!$emailRecord) {
            $emailRecord = SendEmailModel::create([
                'user_id' => $this->user->id,
                'is_sent' => false,
                'is_retry' => 0,
                'subject' => $this->subject,
                'body' => $this->message
            ]);
        }

        try {
            Mail::to($this->user->email)->send(new welcomeemail($this->message, $this->subject));
            
            $emailRecord->update(['is_sent' => true]);
            
        } catch (Exception $e) {
            // Increment is_retry on failure
            $emailRecord->increment('is_retry');

            throw $e; 
        }
    }
}
