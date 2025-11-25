<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SendEmail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
        $users = User::factory()->count(4)->create();
        
        // Create one send_email for each user (one-to-one relationship)
        foreach ($users as $user) {
            SendEmail::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
