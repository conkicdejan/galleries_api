<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->city(),
            'description' => $this->faker->optional()->text(),
            'user_id' => User::inRandomOrder()->first(),
            'created_at' => $this->faker->dateTimeThisDecade('now', 'Europe/Belgrade')
        ];
    }
}
