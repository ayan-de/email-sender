<?php

namespace App\Http\Controllers;
use App\Jobs\SendEmail;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\welcomeemail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $toEmail = 'deayan252@gmail.com';
        $message = 'This is a test email.';
        $subject = 'Test Email';
        // Find the user by email — the SendEmail job expects an App\Models\User instance
        $user = User::where('email', $toEmail)->first();

        if (! $user) {
            return response()->json(['error' => 'User not found for email: ' . $toEmail], 404);
        }

        // Dispatch the job (it will send the mail). Do not call Mail::send() here to avoid duplicate sends.
        dispatch(new SendEmail($user, $message, $subject));

        return response()->json(['status' => 'dispatched']);
    }
}
