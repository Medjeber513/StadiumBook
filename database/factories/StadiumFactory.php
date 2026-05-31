<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stadium>
 */
class StadiumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                    'name' => 'Stadium ' . $this->faker->city(),
        'location' => $this->faker->address(),
        'price' => $this->faker->numberBetween(800, 1200),
        'maxPlayer' => $this->faker->numberBetween(10, 22),
        'minPlayer' => $this->faker->numberBetween(5, 9),
        'openTime' => '08:00',
        'closeTime' => '23:00',
        'owner_id' => User::where('role', 'owner')->inRandomOrder()->first()->id,
        ];
    }
}
