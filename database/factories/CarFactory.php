<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'model' => $this->faker->word(),
            'number' => $this->faker->bothify('######-?-##'),
            'site' => $this->faker->randomElement(['Guelmim', 'Ouarzazate']),
            'user_id' => User::inRandomOrder()->value('id')
        ];
    }
}
