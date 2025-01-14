<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Ville;
use App\Models\Region;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mission>
 */
class MissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // dd(Car::where('user_id', 1)->get());
        return [
            'serial_number' => $this->faker->randomNumber(5, true),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            "type" => $this->faker->word(),
            "agent" => $this->faker->username(),
            'car_id' => Car::inRandomOrder()->value('id'),
            'driver_id' => Driver::inRandomOrder()->value('id'),
            'destination_ville' => Ville::inRandomOrder()->value('id'),
            'depart_ville' => Ville::inRandomOrder()->value('id'),
            "avance" => $this->faker->randomNumber(3, true),
            "reste" => $this->faker->randomNumber(3, true),
            "permission" => $this->faker->word(),
            'user_id' => User::inRandomOrder()->value('id')
        ];
    }
}
