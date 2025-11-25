<?php

namespace Database\Factories;

use App\Models\SendEmail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SendEmail>
 */
class SendEmailFactory extends Factory
{

    protected $model = SendEmail::class;


    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'is_sent' => 0,
            'is_retry' => 0,
        ];
    }

    public function sent(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_sent' => true,
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_sent' => false,
        ]);
    }


    public function retryCount(int $count): static
    {
        return $this->state(fn (array $attributes) => [
            'is_retry' => min(max($count, 0), 3), // Clamp between 0 and 3
        ]);
    }
}
