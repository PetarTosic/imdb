<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'year' => $this->faker->year(),
            'duration' => $this->faker->numberBetween(50, 200),
            'user_score' => $this->faker->numberBetween(1, 10),
            'pegi' => $this->faker->numberBetween(3, 18),
            'image_url' => $this->faker->imageUrl(),
            'description' => $this->faker->realText(1000),
            'published_at' => $this->faker->date(),
            'user_id' => User::factory(1)->create()[0]
        ];
    }
}
