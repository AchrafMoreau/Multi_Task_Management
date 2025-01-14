<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->username(),
            'licenss' => $this->faker->mimeType(),
            'age' => $this->faker->numberBetween(10, 100),
            'user_id' => User::inRandomOrder()->value('id')
        ];
    }
}
