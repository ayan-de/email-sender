<?php

namespace App\Http\Controllers;

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

        $request = Mail::to($toEmail)->send(new welcomeemail($message,$subject));

        dd($request);
    }
}
