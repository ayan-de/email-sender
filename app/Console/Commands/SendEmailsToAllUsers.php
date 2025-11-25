<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\SendEmail as SendEmailModel;
use App\Jobs\SendEmail as SendEmailJob;

class SendEmailsToAllUsers extends Command
{

    protected $signature = 'app:send-emails-to-all-users {--subject= : Email subject} {--message= : Email body/message} {--force : Force resend even if already sent}';

    protected $description = 'Dispatch queued SendEmail jobs for every user in the users table.';

    public function handle()
    {
        $subject = $this->option('subject') ?? 'Welcome';
        $message = $this->option('message') ?? 'Hello, this is a welcome message.';
        $force = $this->option('force') ?? false;

        $users = User::all();

        if ($users->isEmpty()) {
            $this->info('No users found.');
            return 0;
        }

        $bar = $this->output->createProgressBar($users->count());
        $bar->start();

        foreach ($users as $user) {
            // create or update a send_email record for this user
            $emailRecord = SendEmailModel::updateOrCreate(
                ['user_id' => $user->id],
                ['subject' => $subject, 'body' => $message, 'is_sent' => false, 'is_retry' => 0]
            );

            // If not forcing, skip if already sent
            if (!$force && $emailRecord->is_sent) {
                $bar->advance();
                continue;
            }

            // Dispatch the SendEmail job to the queue
            SendEmailJob::dispatch($user, $message, $subject);

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Dispatched send email jobs for users.');
        return 0;
    }
}
