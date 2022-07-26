<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'gallery_id' => Gallery::inRandomOrder()->first(),
            'url' => "https://spaceplace.nasa.gov/blue-sky/en/bluesky.en.png",
        ];
    }
}
