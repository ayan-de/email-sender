<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

Route::get('/', function () {
    $users = \App\Models\User::leftJoin('send_email', 'users.id', '=', 'send_email.user_id')
        ->select('users.name', 'users.email', 'send_email.is_sent', 'send_email.is_retry')
        ->get();
    
    return view('welcome', [
        'users' => $users,
    ]);
});

Route::get('/send-email', [EmailController::class, 'sendEmail']);
