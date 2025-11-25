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
        $users = User::factory()->count(10)->create();
        SendEmail::factory()->count(10)->create();
    }
}
